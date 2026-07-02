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

        $fullPath = $disk->path($path);
        $src = self::loadImage($fullPath);

        if (! $src) {
            return $path;
        }

        $width = imagesx($src);
        $height = imagesy($src);
        $size = min($width, $height);
        $srcX = (int) (($width - $size) / 2);
        $srcY = (int) (($height - $size) / 2);

        $dest = imagecreatetruecolor($size, $size);
        imagesavealpha($dest, true);
        $transparent = imagecolorallocatealpha($dest, 0, 0, 0, 127);
        imagefill($dest, 0, 0, $transparent);

        imagecopyresampled($dest, $src, 0, 0, $srcX, $srcY, $size, $size, $size, $size);
        imagedestroy($src);

        $radius = $size / 2;
        $radiusSquared = $radius * $radius;

        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                $dx = $x - $radius + 0.5;
                $dy = $y - $radius + 0.5;

                if (($dx * $dx) + ($dy * $dy) > $radiusSquared) {
                    imagesetpixel($dest, $x, $y, $transparent);
                }
            }
        }

        $newPath = preg_replace('/\.[^.]+$/', '', $path) . '-round.png';

        if ($newPath !== $path && $disk->exists($path)) {
            $disk->delete($path);
        }

        imagepng($dest, $disk->path($newPath));
        imagedestroy($dest);

        return $newPath;
    }

    private static function loadImage(string $fullPath): ?\GdImage
    {
        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));

        return match ($extension) {
            'png' => @imagecreatefrompng($fullPath) ?: null,
            'jpg', 'jpeg' => @imagecreatefromjpeg($fullPath) ?: null,
            'webp' => function_exists('imagecreatefromwebp') ? (@imagecreatefromwebp($fullPath) ?: null) : null,
            'gif' => @imagecreatefromgif($fullPath) ?: null,
            default => null,
        };
    }
}
