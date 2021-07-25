<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $appends = ['logo_url'];

    protected $fillable = ['name', 'slug', 'status', 'description', 'logo', 'is_featured', 'meta_title', 'meta_keywords', 'meta_description'];


    public function getLogoUrlAttribute()
    {
        return url("/storage/images/uploads/{$this->logo}");
    }

    protected $casts = ['status' => 'boolean', 'is_featured' => 'boolean'];
}
