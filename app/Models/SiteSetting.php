<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, ?string $default = null): ?string
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function asset(string $key, ?string $default = null): ?string
    {
        $path = static::get($key);

        if (! $path) {
            return $default;
        }

        $url = str_starts_with($path, 'http') ? $path : asset('storage/' . ltrim($path, '/'));

        if ($key === 'site_favicon' && ! str_starts_with($path, 'http')) {
            $fullPath = storage_path('app/public/' . ltrim($path, '/'));
            if (is_file($fullPath)) {
                $url .= '?v=' . filemtime($fullPath);
            }
        }

        return $url;
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function getJson(string $key, array $default = []): array
    {
        $value = static::get($key);

        if (! $value) {
            return $default;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : $default;
    }

    public static function setJson(string $key, array $value): void
    {
        static::set($key, json_encode($value));
    }
}
