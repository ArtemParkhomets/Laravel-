<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
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
       $categoryList = DB::table('categories')->paginate(4);
       Paginator::useBootstrap();

       return view('admin/categories',compact('categoryList'));
    }

    public function createCategory(CreateCategoryRequest $req)
    {
        $cat              = new Category();
        $cat->title       = $req->input('title');
        $cat->description = $req->input('description');
        if(empty($cat['title_slug'])){
            $cat['title_slug'] = Str::slug($req->input('title'));
        }
        $cat->save();

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

        return view('admin/category_edit', compact('cat_edit'));
    }

    public function update(Request $req, int $id)
    {
        $cat  = Category::find($id);
        $data = $req->only('title', 'description');
        $cat->update($data);

        return redirect()->route('admin.categories');
    }

    public function products()
    {
        $productList = DB::table('products')->paginate();
        Paginator::useBootstrap();

        return view('admin/products', compact('productList'));
    }

    public function createForm()
    {
        $categoryList = DB::table('categories')->get();

        return view('admin/create_product', compact('categoryList'));
    }

    public function createProduct(CreateProductRequest $req)
    {
        $prod = new Product();
        $prod->title         = $req->input('title');
        $prod->description   = $req->input('description');
        $prod->price         = $req->input('price');
        $prod->categories_id = $req->input('categories_id');
        if(empty($prod['title_slug'])){
            $prod['title_slug'] = Str::slug($req->input('title'));
        }
        $prod->save();

        return redirect(route('admin.products'));
    }

    public function showAllProducts()
    {
        $columns = [
            'title',
            'id',
            'price',
            'categories_id',
            'description',
        ];
        $result = Product::select($columns)->with(['category'])->paginate();
        Paginator::useBootstrap();

        return view('admin/products', compact('result'));
    }

    public function deleteProduct(int $id)
    {
        Product::find($id)->delete();

        return back();
    }

    public function editProduct(int $id)
    {
        $categoryList = DB::table('categories')->get();
        $prod         = Product::find($id);

        return view('admin/update_product', compact('prod','categoryList'));
    }

    public function updateProduct(CreateProductRequest $req, int $id)
    {
        $prod = Product::find($id);
        $data = $req->only('title', 'description', 'price', 'categories_id');
        $prod->update($data);

        return redirect(route('admin.products'));
    }
}
