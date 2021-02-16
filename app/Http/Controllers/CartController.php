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
    public function editCart(Request $request, int $id)
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
        // хер знает как до этих итемсов добраться) подскажи )
        if (empty($items)){
            return redirect(route('cart'))->withErrors(['cart'=>'Нужно что-то положить в корзинку, негодник']);
        }
        $userId     = auth()->id();
        $totalPrice = \Cart::session(auth()->id())->getTotal();

        try {
            $order = Order::create([
                'user_id'   => $userId,
                'status'    => 'В обработке',
                'totalPrice'=> $totalPrice,
            ]);
        } catch (\Throwable $exception) {
            redirect(route('cart'))->withErrors(['cart' => 'другая ошибка']);
        }

//        $orderId=$order->id;
        foreach ($items as $item) {
            $order->orderProducts()->create([
                'product_id'       => $item->id,
                'product_price'    => $item->price,
                'product_quantity' => $item->quantity,
            ]);
        }

        DB::table('order_products')->insert($orderProduct);

        \Cart::session(auth()->id())->clear();

        return back();
    }
}
