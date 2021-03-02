<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categoryList = DB::table('categories')->paginate(4);
        Paginator::useBootstrap();

        return view('admin/categories', compact('categoryList'));
    }

    public function create(CreateCategoryRequest $req)
    {
        $cat              = new Category();
        $cat->title       = $req->input('title');
        $cat->description = $req->input('description');

        if (empty($cat['title_slug'])) {
            $cat['title_slug'] = Str::slug($req->input('title'));
        }
        $cat->save();

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

    public function delete(int $id)
    {
        Category::find($id)->delete();

        return redirect(route('admin.categories'));
    }
}
