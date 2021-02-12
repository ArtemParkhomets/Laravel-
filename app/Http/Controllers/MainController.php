<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery=Product::query();
        if($request->filled('price_from')){
            $productsQuery->where('price','>=',$request->price_from);
        }
        if($request->filled('price_to')){
            $productsQuery->where('price','<=',$request->price_to);
        }
        foreach ([$request->categories_id] as $id){
            if($request->filled('categories_id')){
                $productsQuery->whereIn('categories_id',$id);
            }
        }
        if($request->filled('search')){
            $productsQuery->where('title','like', '%'.$request->search.'%');
        }
        $columns=['id', 'title', 'description', 'price', 'new_price', 'categories_id',];
        $products=$productsQuery->select($columns)->with('category')->paginate(6);
        Paginator::useBootstrap();
        $categories=Category::select(['title','id'])->get();
        unset($productsQuery);

        return view('main', compact(['categories','products']));
    }
    public function categories()
    {
        $categoryList= DB::table('categories')->get();

        return view('categories', compact('categoryList'));
    }
}
