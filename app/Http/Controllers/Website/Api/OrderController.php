<?php

namespace App\Http\Controllers\Website\Api;

use App\Helpers\OrderHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct(OrderHelper $orderHelper)
    {
        $this->order_helper = $orderHelper;
    }

    public function placeOrder(Request $request)
    {
        $rules = [
            'full_name' => 'required',
            'phone_number' => 'required|numeric',
            'secondary_phone_number' => 'numeric',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
            'landmark' => 'required',
        ];
        $request->validate($rules);

        $order_id = $this->order_helper->placeOrder($request);
        return view('website.pages.order-success', compact('order_id'));
    }

    public function processOrder(Request $request)
    {
        $rules = [
            'full_name' => 'required',
            'phone_number' => 'required|numeric',
            'secondary_phone_number' => 'numeric',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
            'landmark' => 'required',
        ];
        $request->validate($rules);

        $response = $this->order_helper->processOrder($request);
        return $response;
    }

    public function getAllOrdersView()
    {
        $orders = $this->order_helper->getAllOrders();
        return view('website.pages.profile.order_list', compact('orders'));
    }

    public function getOrderDetailView($id)
    {
        $order = $this->order_helper->getOrderById($id);
        return view('website.pages.profile.order_detail', compact('order'));
    }

    public function verify_esewa_payment(Request $request)
    {
        $user_id = Auth::user()->id;

        $processed_cart = Cart::select('id')->where('user_id', $user_id)->where('status', 1)->first();

        $processing_order = Order::where('processed_cart', $processed_cart->id)->first();
        $order_id = $processing_order->id;

        $refId = $request->refId;

        $url = "https://uat.esewa.com.np/epay/transrec";
        $data = [
            'amt' => $processing_order->total,
            'rid' => $refId,
            'pid' => 'ICW.' . $order_id,
            'scd' => env('ESEWA_MERCHANT_KEY')
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        if (strpos($response, "Success") == true) {

            $this->order_helper->completeOrder($processing_order, $refId);

            return view('website.pages.order-success', compact('order_id'));
        } else {
            $this->order_helper->revertOrder($processing_order);
            return redirect()->route('checkout');
        }
    }
}
