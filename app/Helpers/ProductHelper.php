<?php

namespace App\Helpers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductHelper
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function getLatestProducts($random = false, $limit = null)
    {
        $products = $this->product->latest();

        if ($limit) {
            $products = $products->limit($limit);
        }

        $products = $products->with('reviews')->get();

        if ($random) {
            $products = $products->shuffle();
        }
        return $products;
    }

    public function getProductsByCategory($category_id, $random = false, $limit = null) //USED ON HOMEPAGE
    {
        $products = $this->product;

        if ($limit) {
            $products = $products->limit($limit);
        }

        $products = $products->with('reviews')->where('category_id', $category_id)->get();

        if ($random) {
            $products = $products->shuffle();
        }

        return $products;
    }

    public function getProducts(Request $request)
    {
        $products = $this->product->with('reviews', 'category:id,name');

        if ($request->has('category')) {
            $this->applyCategoryFilter($request->category, $products);
        }

        if ($request->has('brand')) {
            $this->applyBrandFilter($request->brand, $products);
        }

        if ($request->has('price_range')) {
            $this->applyPriceFilter($request->price_range, $products);
        }

        $products = $products->paginate(20);

        //check if we need to get side bar or not
        if ($request->fetch_side_bar === "true") {

            //Get brand present in these categories bor sidebar.
            $brand_ids = array_unique($products->pluck('brand_id')->toArray());
            $brands = $this->getBrandSideBar($brand_ids);

            //Get highest and lowest price in the particular product list
            $product_price = $products->pluck('original_price')->toArray();
            $min_price = min($product_price);
            $max_price = max($product_price);

            return response()->json(['products' => $products, 'sidebar' => ['brands' => $brands, 'min_price' => $min_price, 'max_price' => $max_price]]);
        }

        return response()->json(['products' => $products]);
    }

    public function applyCategoryFilter($category_slug, $products)
    {
        $category = ProductCategory::where('slug', $category_slug)->first();
        $category_ids = array_merge($category->getAllChildren()->pluck('id')->toArray(), [$category->id]);

        $products = $products->whereIn('category_id', $category_ids);

        return $products;
    }

    public function applyBrandFilter($brand_slug, $products)
    {
        $brand_id = Brand::where('slug', $brand_slug)->pluck('id')->first();

        $products = $products->where('brand_id', $brand_id);

        return $products;
    }

    public function applyPriceFilter($price_range, $products)
    {
        $products = $products->whereBetween('original_price', $price_range);

        return $products;
    }

    public function getBrandSideBar($brand_ids)
    {
        $brands = Brand::whereIn('id', $brand_ids)->get();
        return $brands;
    }
}
