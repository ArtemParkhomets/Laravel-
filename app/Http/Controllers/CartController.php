<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addCart(Request $request, int $id)
    {
        $prod=Product::find($id);
        $prod->quantity=$request->quantity;
        \Cart::session(auth()->id())->add(array(
            'id'=>$prod->id,
            'name'=>$prod->title,
            'price'=>$prod->price,
            'quantity'=>$prod->quantity,
            'associatedModel' => $prod,
        ));

        return back();
    }
    public function index()
    {
        $items = \Cart::session(auth()->id())->getContent()->sortBy('id');

        return view('private',compact('items'));
    }
    public function editCart(Request $request, $id)
    {
        \Cart::session(auth()->id())->update($id,[
            'quantity' => array(
            'relative' => false,
            'value' => $request->quantity,)
            ]);
        return back();
    }
    public function removeCart(int $id)
    {
        \Cart::session(auth()->id())->remove($id);

        return back();
    }
    public function createOrder(Request $request)
    {
        $items = \Cart::session(auth()->id())->getContent();
        $userId=Auth::id();
        $totalPrice=\Cart::session(auth()->id())->getTotal();


      $order= Order::create([
        'user_id'=>$userId,
        'status'=>'В обработке',
        'totalPrice'=>$totalPrice,
    ]);
      $orderId=$order->id;
      //dd($orderId);
        foreach ($items as $item){
            $orderProducts=OrderProduct::create([
                'order_id'=>$orderId,
                'product_id'=>$item->id,
                'product_price'=>$item->price,
                'product_quantity'=>$item->quantity,

            ]);
        }

        \Cart::session(auth()->id())->clear();
      return back();
    }

}
