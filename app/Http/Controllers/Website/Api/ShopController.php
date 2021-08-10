<?php

namespace App\Http\Controllers\Website\API;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Helpers\ProductHelper;
use App\Models\Product;

class ShopController extends Controller
{
    public function __construct(ProductHelper $productHelper)
    {
        $this->product_helper = $productHelper;
    }

    public function getCategories()
    {
        $categories = ProductCategory::select('id', 'name', 'icon', 'parent_id', 'slug')->with('children:id,name,icon,parent_id,slug')->where('parent_id', null)->get();
        return response()->json(['data' => $categories]);
    }

    public function getProducts(Request $request)
    {
        $response = $this->product_helper->getProducts($request);
        return $response;
    }
}
