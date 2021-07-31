<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends = ['product_images_array', 'images_url'];

    protected $fillable = [
        'name',
        'slug',
        'product_code',
        'short_description',
        'description',
        'stock',
        'original_price',
        'discount',
        'selling_price',
        'category_id',
        'brand_id',
        'product_images',
        'status',
        'is_featured',
        'specifications',
        'weight',
        'length',
        'width',
        'height',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(RatingReview::class, 'product_id')->where('status', 1);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews->avg('rating') ?? 0;
    }

    public function getProductImagesArrayAttribute()
    {
        if ($this->product_images) {
            return explode(', ', $this->product_images);
        }
        return [];
    }

    public function getImagesUrlAttribute()
    {
        if ($this->product_images) {
            $images = $this->product_images_array;
            $images_url = array();
            foreach ($images as $image) {
                $images_url[] = url("/storage/images/uploads/{$image}");
            }
            return $images_url;
        }
        return [];
    }
}
