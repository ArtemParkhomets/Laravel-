<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

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

}
