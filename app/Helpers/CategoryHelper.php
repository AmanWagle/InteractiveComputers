<?php

namespace App\Helpers;

use App\Models\ProductCategory;

class CategoryHelper
{
    public function __construct(ProductCategory $category)
    {
        $this->category = $category;
    }


    public function getFeaturedCategories($random = false, $limit = null)
    {
        $categories = $this->category;

        if ($limit) {
            $categories = $categories->limit($limit);
        }

        $categories = $categories->where('is_featured', true)->get();

        if ($random) {
            $categories = $categories->shuffle();
        }

        return $categories;
    }
}