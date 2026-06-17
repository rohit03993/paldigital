<?php

namespace App\Concerns;

trait HasStorageImage
{
    public function imageUrl(?string $column = 'image'): ?string
    {
        $path = $this->{$column};

        if (! $path) {
            return null;
        }

        return str_starts_with($path, 'http') ? $path : asset('storage/' . ltrim($path, '/'));
    }
}
