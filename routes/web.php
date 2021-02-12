<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\MainController::class,'index'])->name('home');
Route::get('/categories', [\App\Http\Controllers\MainController::class,'categories'])->name('categories');
Route::get('/registration', [\App\Http\Controllers\RegistrationController::class, 'reg_v'])->name('reg_v');
Route::post('/save', [\App\Http\Controllers\RegistrationController::class, 'save'])->name('save_user');
Route::view('/login','auth/login')->name('login');
Route::post('/login',[\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\RegistrationController::class, 'logout'])->name('logout');
Route::get('admin/home',[\App\Http\Controllers\AdminController::class, 'home'])->middleware('auth')->name('admin.home');
Route::post('admin/home/create_category',[\App\Http\Controllers\AdminController::class,'create_category'])->name('create_category');
Route::delete('{id}',[\App\Http\Controllers\AdminController::class,'delete'])->name('admin.delete');
Route::get('/admin/categories',[\App\Http\Controllers\AdminController::class,'categories'])->name('admin.categories');
Route::get('{id}/update', [\App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
Route::patch('{id}', [\App\Http\Controllers\AdminController::class,'update'])->name('update.category');
Route::get('/admin/products', [\App\Http\Controllers\AdminController::class,'showAllProducts'])->name('admin.products');
Route::get('/admin/create', [\App\Http\Controllers\AdminController::class,'createform'])->name('admin.create.product');
Route::post('/admin/create', [\App\Http\Controllers\AdminController::class,'createproduct'])->name('createproduct');
Route::get('/filter',[\App\Http\Controllers\FilterController::class,'filter'])->name('filter');
Route::get('/cart',[\App\Http\Controllers\CartController::class,'index'])->middleware('auth')->name('cart');
Route::post('/cart/{id}',[\App\Http\Controllers\CartController::class,'addCart'])->middleware('auth')->name('add.cart');
Route::post('/cart/update/{id}',[\App\Http\Controllers\CartController::class,'editCart'])->middleware('auth')->name('edit.cart');

