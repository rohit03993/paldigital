<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class FaviconProcessor
{
    public static function applyCircleMask(string $path): string
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            return $path;
        }

        $src = self::loadImage($disk->path($path));

        if (! $src) {
            return $path;
        }

        $width = imagesx($src);
        $height = imagesy($src);
        $cropSize = min($width, $height);
        $srcX = (int) (($width - $cropSize) / 2);
        $srcY = (int) (($height - $cropSize) / 2);
        $outputSize = self::normalizeSize($cropSize);

        $dest = imagecreatetruecolor($outputSize, $outputSize);
        imagesavealpha($dest, true);
        imagealphablending($dest, false);
        $transparent = imagecolorallocatealpha($dest, 0, 0, 0, 127);
        imagefill($dest, 0, 0, $transparent);
        imagealphablending($dest, true);

        imagecopyresampled($dest, $src, 0, 0, $srcX, $srcY, $outputSize, $outputSize, $cropSize, $cropSize);
        imagedestroy($src);

        self::stripDarkBackground($dest, $outputSize);
        self::applyAntialiasedCircleMask($dest, $outputSize);

        $newPath = preg_replace('/-round\.png$/', '', $path);
        $newPath = preg_replace('/\.[^.]+$/', '', $newPath) . '-round.png';

        if ($disk->exists($newPath) && $newPath !== $path) {
            $disk->delete($newPath);
        }

        if ($newPath !== $path && $disk->exists($path)) {
            $disk->delete($path);
        }

        imagealphablending($dest, false);
        imagesavealpha($dest, true);
        imagepng($dest, $disk->path($newPath), 9);
        imagedestroy($dest);

        return $newPath;
    }

    private static function normalizeSize(int $size): int
    {
        return max(32, min(192, $size));
    }

    private static function loadImage(string $fullPath): ?\GdImage
    {
        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));

        $src = match ($extension) {
            'png' => @imagecreatefrompng($fullPath) ?: null,
            'jpg', 'jpeg' => @imagecreatefromjpeg($fullPath) ?: null,
            'webp' => function_exists('imagecreatefromwebp') ? (@imagecreatefromwebp($fullPath) ?: null) : null,
            'gif' => @imagecreatefromgif($fullPath) ?: null,
            default => null,
        };

        if (! $src) {
            return null;
        }

        imagesavealpha($src, true);
        imagealphablending($src, true);

        return $src;
    }

    private static function stripDarkBackground(\GdImage $image, int $size): void
    {
        imagealphablending($image, false);
        imagesavealpha($image, true);

        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                $rgba = imagecolorsforindex($image, imagecolorat($image, $x, $y));

                if ($rgba['red'] <= 45 && $rgba['green'] <= 45 && $rgba['blue'] <= 45) {
                    imagesetpixel($image, $x, $y, imagecolorallocatealpha($image, 0, 0, 0, 127));
                }
            }
        }
    }

    private static function applyAntialiasedCircleMask(\GdImage $image, int $size): void
    {
        imagealphablending($image, false);
        imagesavealpha($image, true);

        $radius = $size / 2;
        $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);

        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                $dx = $x - $radius + 0.5;
                $dy = $y - $radius + 0.5;
                $distance = sqrt(($dx * $dx) + ($dy * $dy));

                if ($distance > $radius) {
                    imagesetpixel($image, $x, $y, $transparent);
                } elseif ($distance > $radius - 1.5) {
                    $edgeAlpha = (int) (127 * min(1, ($distance - ($radius - 1.5)) / 1.5));
                    $rgba = imagecolorsforindex($image, imagecolorat($image, $x, $y));
                    $alpha = min(127, max($rgba['alpha'], $edgeAlpha));
                    $color = imagecolorallocatealpha($image, $rgba['red'], $rgba['green'], $rgba['blue'], $alpha);
                    imagesetpixel($image, $x, $y, $color);
                }
            }
        }
    }
}
