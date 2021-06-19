<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $appends = ['thumbnail_url'];

    protected $fillable = ['title', 'slug', 'short_description', 'description', 'thumbnail', 'meta_title', 'meta_keywords', 'meta_description'];

    public function getThumbnailUrlAttribute()
    {
        return url("/storage/images/uploads/{$this->thumbnail}");
    }

}
