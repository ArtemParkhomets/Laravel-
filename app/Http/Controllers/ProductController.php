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

class ProductController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }

    public function createForm()
    {
        $categoryList = DB::table('categories')->get();

        return view('admin/create_product', compact('categoryList'));
    }

    public function create(CreateProductRequest $req)
    {
        $prod = new Product();
        $prod->title         = $req->input('title');
        $prod->description   = $req->input('description');
        $prod->price         = $req->input('price');
        $prod->categories_id = $req->input('categories_id');

        if (empty($prod['title_slug'])) {
            $prod['title_slug'] = Str::slug($req->input('title'));
        }
        $prod->save();

        return redirect(route('admin.products'));
    }

    public function index()
    {
        $columns = [
            'title',
            'id',
            'price',
            'categories_id',
            'description',
        ];
        $result = Product::select($columns)->with('category')->paginate();
        Paginator::useBootstrap();

        return view('admin/products', compact('result'));
    }

    public function delete(int $id)
    {
        Product::find($id)->delete();

        return back();
    }

    public function edit(int $id)
    {
        $categoryList = DB::table('categories')->get();
        $prod         = Product::find($id);

        return view('admin/update_product', compact('prod','categoryList'));
    }

    public function update(CreateProductRequest $req, int $id)
    {
        $prod = Product::find($id);
        $data = $req->only('title', 'description', 'price', 'categories_id');
        $prod->update($data);

        return redirect(route('admin.products'));
    }
}
