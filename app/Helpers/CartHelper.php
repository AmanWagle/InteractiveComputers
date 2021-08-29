<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartHelper
{
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function addToCart(Request $request)
    {
        if (Auth::check()) {        //Check if authenticated user
            $user_id = Auth::user()->id;

            $cart = Cart::firstOrCreate([
                'user_id' => $user_id,
                'status' => 1
            ], [
                'status' =>  1,
                'total' => 0
            ]);
        } else {        //If not authenticated
            $ip_address = $request->ip();

            $cart = Cart::firstOrCreate([
                'ip_address' => $ip_address,
                'status' => 1
            ], [
                'status' =>  1,
                'total' => 0
            ]);
        }

        $cart_item = $this->addItemToCart($cart->id, $request);

        $cart->update([         //update the total amount need to be payed.
            'total' => $cart->total + $cart_item->total
        ]);

        return response()->json(['success' => true, 'message' => 'Product added to cart successfully!']);
    }


    //function to add each item to above created cart.
    public function addItemToCart($cart_id, Request $request)
    {
        $product_id = $request->product_id;
        $product_quantity = $request->product_quantity;

        $product = Product::select('id', 'name', 'slug', 'original_price', 'discount', 'selling_price')->where('id', $product_id)->first();

        $cart_item = CartItem::where('cart_id', $cart_id)->where('product_id', $product_id)->first();

        if (!$cart_item) {         //if product is not present in cart.
            if ($product->discount) {       //check if product is discounted
                $total = $product_quantity * $product->selling_price;
            } else {
                $total = $product_quantity * $product->original_price;
            }

            $cart_item = CartItem::create([
                'cart_id' => $cart_id,
                'product_id' => $product_id,
                'quantity' => $product_quantity,
                'total' => $total
            ]);

            return $cart_item;
        } else {        //if product is already present in cart.

            $existing_quantity = $cart_item->quantity;

            $new_quantity = $existing_quantity + $product_quantity;

            if ($product->discount) {       //check if product is discounted
                $new_total = $new_quantity * $product->selling_price;
            } else {
                $new_total = $new_quantity * $product->original_price;
            }

            $cart_item->update([
                'quantity' => $new_quantity,
                'total' => $new_total
            ]);

            return $cart_item;
        }
    }

    //function to get active cart items
    public function getActiveCart()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cart = Cart::with('cart_items.product:id,name,slug,original_price,discount,selling_price,product_images')->where('user_id', $user_id)->where('status', 1)->first();
        } else {
            $ip_address = request()->ip();
            $cart = Cart::with('cart_items.product:id,name,slug,original_price,discount,selling_price,product_images')->where('ip_address', $ip_address)->where('status', 1)->first();
        }
        return $cart;
    }

    //function to remove product from cart
    public function removeFromCart($cart_item_id)
    {
        $select_item = CartItem::where('id', $cart_item_id)->with('cart')->first();
        $item_total = $select_item->total;

        $cart = $select_item->cart;

        $cart->update([
            'total' => $cart->total - $item_total
        ]);

        $select_item->delete();
        return response()->json(['success' => true, 'message' => "Product removed from cart."]);
    }
}
