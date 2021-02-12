<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class FilterController extends Controller
{
    public function filter(Request $req)
    {
        dd($req);
        $categories=Category::select(['title','id'])->get();
        foreach ($req->categories_id as $id){
            $result=Product::select(['title','description','price','new_price','categories_id'])
                ->where('categories_id','=', $id)
                ->get();
        }
        //dd($result);
        return view('filter',compact(['result','categories']));
    }
}
