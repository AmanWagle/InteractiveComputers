<?php

namespace App\Http\Controllers\Website\Api;

use App\Helpers\CartHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(CartHelper $cartHelper)
    {
        $this->cart_helper = $cartHelper;
    }

    public function addToCart(Request $request)
    {
        $response = $this->cart_helper->addToCart($request);
        return $response;
    }

    public function getCartItems(){
        $response = $this->cart_helper->getActiveCart();
        return $response;
    }

    public function removeFromCart($id){
        return $this->cart_helper->removeFromCart($id);
    }
}
