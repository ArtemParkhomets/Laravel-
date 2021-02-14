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
        $orders=Order::all();
        $ordersInProcess=Order::where('status','В обработке')->with('user')->get();
        $ordersSent=Order::where('status','Отправлен')->with('user')->get();
        $ordersDelivered=Order::where('status','Доставлен')->with('user')->get();

        return view('admin/adminOrders', compact(['orders','ordersInProcess','ordersSent','ordersDelivered']));
    }
    public function sentOrder(int $id)
    {
        $order=Order::find($id);
        $order->status=('Отправлен');
        $order->update();


        return back();
    }
    public function seeOrder(int $id)
    {
        $order=OrderProduct::find($id)->with('product')->get();

        //dd($order);
        return view('admin/seeorder', compact('order'));
    }
}
