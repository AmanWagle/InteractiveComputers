<?php

namespace App\Http\Controllers\Website\Api;

use App\Helpers\OrderHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct(OrderHelper $orderHelper)
    {
        $this->order_helper = $orderHelper;
    }

    public function store(Request $request)
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

        $response = $this->order_helper->placeOrder($request);
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
}
