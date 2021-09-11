<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Artesaos\SEOTools\Facades\SEOTools;

class ProductDetailController extends Controller
{
    public function index(Product $product)
    {
        $product->load('brand', 'category', 'reviews.user');
        //for seo
        SEOTools::setTitle($product->name);
        SEOTools::setDescription($product->short_description);
        return view('website.pages.product-detail', compact('product'));
    }
}
