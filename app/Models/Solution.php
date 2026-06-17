<?php

namespace App\Models;

use App\Concerns\HasStorageImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Solution extends Model
{
    use HasStorageImage;
    protected $fillable = [
        'title', 'slug', 'description', 'features', 'is_flagship',
        'image', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'is_flagship' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Solution $solution) {
            if (empty($solution->slug)) {
                $solution->slug = Str::slug($solution->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}
