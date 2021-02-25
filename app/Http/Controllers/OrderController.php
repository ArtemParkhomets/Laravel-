<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    public function index()
    {
        $ordersInProcess = Order::where('status', 'В обработке')->with('user')->get();
        $ordersSent      = Order::where('status', 'Отправлен')->with('user')->get();

        return view('admin/orders', compact('ordersInProcess', 'ordersSent'));
    }

    public function sent(int $id)
    {
        $order = Order::find($id);
        $order->update(['status' => 'Отправлен']);

        return back();
    }

    public function show(int $id, int $totalPrice)
    {
        $order = OrderProduct::where('order_id', $id)->with('product')->get();

        return view('admin/see_order', compact('order', 'id', 'totalPrice'));
    }

}
