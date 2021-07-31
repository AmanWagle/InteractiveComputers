<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function index(Product $product)
    {
        $product->load('brand', 'category', 'reviews.user');
        return view('website.pages.product-detail', compact('product'));
    }
}
