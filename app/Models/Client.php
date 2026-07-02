<?php

namespace App\Models;

use App\Concerns\HasStorageImage;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasStorageImage;

    protected $fillable = [
        'company_name',
        'category',
        'logo',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
