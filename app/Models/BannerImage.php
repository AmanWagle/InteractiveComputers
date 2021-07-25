<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    use HasFactory;

    protected $appends = ['banner_image_url'];

    protected $fillable = ['name', 'link', 'status', 'banner_id'];

    public function getBannerImageUrlAttribute()
    {
        return url("/storage/images/uploads/{$this->name}");
    }
}
