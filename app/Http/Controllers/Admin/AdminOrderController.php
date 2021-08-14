<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        return view('admin.pages.order.index');
    }

    public function getAllOrders()
    {
        $orders = Order::with('order_items', 'user')->get();
        return response()->json(['data' => $orders]);
    }

    public function orderDetails($id)
    {
        $order_id = $id;
        return view('admin.pages.order.detail', compact('order_id'));
    }

    public function orderData($id)
    {
        $order = Order::with('order_items.product', 'user')->find($id);
        return response()->json(['data' => $order]);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update([
            'status' => ($request->status),
        ]);

        return response()->json(['success' => true, 'message' => "Order status changed to {$request->status}"]);
    }

    public function togglePayment(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update([
            'payment' => ($request->payment) ? 1 : 0,
        ]);

        $action = ($request->payment == 1) ? 'done.' : 'undone.';

        return response()->json(['success' => true, 'message' => "Payment is {$action}"]);
    }
}
