<?php

namespace App\Support;

class UploadPath
{
    public static function fromFilamentState(mixed $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        if (is_string($value)) {
            return $value;
        }

        if (is_array($value)) {
            foreach ($value as $item) {
                if (is_string($item) && $item !== '') {
                    return $item;
                }
            }
        }

        return null;
    }

    public static function isExplicitlyRemoved(mixed $value): bool
    {
        return is_array($value) && empty($value);
    }
}
