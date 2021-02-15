<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProducts;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $ordersInProcess=Order::where('status','В обработке')->with('user')->get();
        $ordersSent=Order::where('status','Отправлен')->with('user')->get();

        return view('admin/adminOrders', compact('ordersInProcess', 'ordersSent'));
    }
    public function sentOrder(int $id)
    {
        $order = Order::find($id);
        $order->update(['status' => 'Отправлен']);

        return back();
    }
    public function seeOrder(int $id, int $totalPrice)
    {
        $total = $totalPrice;
        $order = OrderProduct::find($id)->with('product')->get();

        return view('admin/seeorder', compact('order', 'id', 'total'));
    }

}
