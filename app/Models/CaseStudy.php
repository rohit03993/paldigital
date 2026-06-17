<?php

namespace App\Models;

use App\Concerns\HasStorageImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CaseStudy extends Model
{
    use HasStorageImage;
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'client', 'industry',
        'image', 'results', 'sort_order', 'is_active', 'is_published', 'published_at',
    ];

    protected $casts = [
        'results' => 'array',
        'is_active' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (CaseStudy $caseStudy) {
            if (empty($caseStudy->slug)) {
                $caseStudy->slug = Str::slug($caseStudy->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->where('is_active', true);
    }
}
