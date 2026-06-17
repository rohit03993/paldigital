<?php

namespace App\Models;

use App\Concerns\HasStorageImage;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasStorageImage;
    protected $fillable = [
        'name', 'role', 'company', 'content', 'avatar',
        'rating', 'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
