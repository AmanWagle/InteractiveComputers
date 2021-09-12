<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class ProductDetailController extends Controller
{
    public function index(Product $product)
    {
        $product->load('brand', 'category', 'reviews.user');
        //for seo
        SEOTools::setTitle(($product->meta_title) ? $product->meta_title : $product->name);
        SEOTools::setDescription(($product->meta_description) ? $product->meta_description : $product->short_description);
        SEOMeta::addKeyword(explode(',', $product->meta_keywords));
        SEOTools::jsonLd()->addImage($product->images_url[0]);

        return view('website.pages.product-detail', compact('product'));
    }
}
