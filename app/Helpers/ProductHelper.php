<?php

namespace App\Helpers;

use App\Models\Product;

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

        $products = $products->get();

        if ($random) {
            $products = $products->shuffle();
        }
        return $products;
    }

    public function getProductsByCategory($category_id, $random = false, $limit = null)
    {
        $products = $this->product;

        if ($limit) {
            $products = $products->limit($limit);
        }

        $products = $products->where('category_id', $category_id)->get();

        if ($random) {
            $products = $products->shuffle();
        }

        return $products;

    }
}
