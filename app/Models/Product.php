<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
}
