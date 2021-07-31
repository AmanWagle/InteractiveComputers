<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingReview extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'review_summary', 'review', 'status', 'product_id', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function getRatingPercentageAttribute()
    {
        $rating_percentage = ($this->rating / 5) * 100;
        return $rating_percentage;
    }
}
