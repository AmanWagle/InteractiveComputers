<?php

namespace App\Helpers;

use App\Models\Brand;

class BrandHelper
{
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }


    public function getFeaturedBrands($random = false, $limit = null)
    {
        $brands = $this->brand;

        if ($limit) {
            $brands = $brands->limit($limit);
        }

        $brands = $brands->where('is_featured', true)->get();

        if ($random) {
            $brands = $brands->shuffle();
        }

        return $brands;
    }
}