<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }
    public function categories()
    {
       $categoryList= DB::table('categories')->paginate(4);
       Paginator::useBootstrap();

       return view('admin/admincategories',compact('categoryList'));
    }
    public function create_category(Request $req)
    {
       $validate=$req->validate([
           'title'=>'max:100|required',
           'description'=>'max:255|required'
       ]);
       if(empty($validate['title_slug'])){
           $validate['title_slug']=Str::slug($validate['title']);
       }
       $category=Category::create($validate);

       return redirect(route('admin.categories'));
    }

    public function delete(int $id)
    {
       Category::find($id)->delete();

       return redirect(route('admin.categories'));
    }
    public function edit(int $id)
    {
        $cat_edit = Category::find($id);

        return view('admin/admincategoryedit', compact('cat_edit'));
    }
    public function update(Request $req, int $id)
    {
        $cat=Category::find($id);
        $data=$req->only('title', 'description');
        $cat->update($data);

        return redirect()->route('admin.categories');
    }
    public function products()
    {
        $productList= DB::table('products')->paginate();
        Paginator::useBootstrap();

        return view('admin/adminproducts', compact('productList'));
    }
    public function createform()
    {
        $categoryList= DB::table('categories')->get();

        return view('admin/admincreateproduct', compact('categoryList'));
    }
    public function createproduct(Request $req)
    {
        $validate=$req->validate([
            'title'=>'max:100|required',
            'description'=>'max:255|required',
            'price'=>'required',
            'categories_id'=>'required',
        ]);
        if(empty($validate['title_slug'])){
            $validate['title_slug']=Str::slug($validate['title']);
        }
        $product=Product::create($validate);

        return redirect(route('admin.products'));
    }
    public function showAllProducts()
    {
        $columns=[
            'title',
            'id',
            'price',
            'categories_id',
            'description',
        ];
        $result= Product::select($columns)->with(['category'])->paginate();
        Paginator::useBootstrap();

        return view('admin/adminproducts', compact('result'));
    }
}
