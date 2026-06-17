<?php

namespace App\Models;

use App\Concerns\HasStorageImage;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasStorageImage;
    protected $fillable = [
        'name', 'role', 'bio', 'photo', 'linkedin', 'email',
        'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
