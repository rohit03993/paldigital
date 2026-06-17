<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $fillable = ['page', 'title', 'description', 'keywords', 'og_image'];

    public static function forPage(string $page): ?self
    {
        return static::where('page', $page)->first();
    }
}
