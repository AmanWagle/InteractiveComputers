<?php

namespace App\Helpers;

use App\Mail\OrderPlaced;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderHelper
{
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function placeOrder(Request $request)
    {
        $user_id = Auth::user()->id;

        $cart = Cart::where('user_id', $user_id)->where('status', 1)->first();

        $cart_items = CartItem::where('cart_id', $cart->id)->with('product')->get();

        $order = Order::create([
            'user_id' => $user_id,
            'status' => "Pending",
            'payment_method' => $request->payment_method,
            'total' => 0,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'secondary_phone_number' => $request->secondary_phone_number,
            'province' => $request->province,
            'district' => $request->district,
            'city' => $request->city,
            'landmark' => $request->landmark,
            'order_note' => $request->order_note,
            'is_processed' => true,
            'processed_cart' => $cart->id
        ]);

        $total = 0;

        foreach ($cart_items as $cart_item) {
            $order_item = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart_item->product_id,
                'quantity' => $cart_item->quantity,
            ]);

            if ($cart_item->product->discount) {       //check if product is discounted
                $item_total = $cart_item->quantity * $cart_item->product->selling_price;
            } else {
                $item_total = $cart_item->quantity * $cart_item->product->original_price;
            }

            $total = $total + $item_total;

            $cart_item->delete();
        }

        //make cart status false
        $cart->status = 0;
        $cart->save();

        $order->update([         //update the total amount need to be payed.
            'total' => $total
        ]);

        $this->notifyAdmin('amanwagle10@gmail.com', $order->id);

        return response()->json(['success' => true, 'message' => 'Order Processed Successfully!']);
    }

    //to save as draft
    public function processOrder(Request $request)
    {
        $user_id = Auth::user()->id;

        $cart = Cart::where('user_id', $user_id)->where('status', 1)->first();

        $cart_items = CartItem::where('cart_id', $cart->id)->with('product')->get();

        $order = Order::create([
            'user_id' => $user_id,
            'total' => 0,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'secondary_phone_number' => $request->secondary_phone_number,
            'province' => $request->province,
            'district' => $request->district,
            'city' => $request->city,
            'landmark' => $request->landmark,
            'order_note' => $request->order_note,
            'is_processed' => false,
            'processed_cart' => $cart->id
        ]);

        $total = 0;

        foreach ($cart_items as $cart_item) {
            $order_item = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart_item->product_id,
                'quantity' => $cart_item->quantity,
            ]);

            if ($cart_item->product->discount) {       //check if product is discounted
                $item_total = $cart_item->quantity * $cart_item->product->selling_price;
            } else {
                $item_total = $cart_item->quantity * $cart_item->product->original_price;
            }

            $total = $total + $item_total;
        }

        $order->update([         //update the total amount need to be payed.
            'total' => $total
        ]);

        return response()->json(['success' => true, 'data' => $order]);
    }

    //complete order if payment is complete
    public function completeOrder($processing_order, $refId)
    {

        $processing_order->update([
            'payment_method' => 'esewa',
            'is_processed' => 1,
            'payment_ref' => $refId,
            'status' => 'pending',
            'payment' => 1
        ]);

        $cart = Cart::with('cart_items')->find($processing_order->processed_cart);
        foreach ($cart->cart_items as $cart_item) {
            $cart_item->delete();
        }
        //make cart status false
        $cart->status = 0;
        $cart->save();

        return;
    }

    //revert order if payment is failed
    public function revertOrder($processing_order)
    {
        $order_items = OrderItem::where('order_id', $processing_order->id)->get();
        foreach ($order_items as $order_item) {
            $order_item->delete();
        }
        $processing_order->delete();
    }

    public function notifyAdmin($to, $order_id)
    {
        $order = $this->getOrderById($order_id);

        Mail::to($to)->send(new OrderPlaced($order));
    }

    public function getAllOrders()
    {
        $user_id = Auth::user()->id;

        $orders = Order::where('user_id', $user_id)->with('order_items')->get();

        return $orders;
    }

    public function getOrderById($id)
    {
        $order = Order::with('user', 'order_items.product')->find($id);
        return $order;
    }
}
