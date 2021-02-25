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
Route::get('/registration', [\App\Http\Controllers\RegistrationController::class, 'registerView'])->name('reg_v');
Route::post('/save', [\App\Http\Controllers\RegistrationController::class, 'save'])->name('save_user');
Route::view('/login','auth/login')->name('login');
Route::post('/login',[\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\RegistrationController::class, 'logout'])->name('logout');
Route::group(['middleware'=>['auth'=>'admin'], 'prefix'=>'admin'],function (){
    Route::post('/home/create_category',[\App\Http\Controllers\CategoriesController::class,'create'])->name('create.category');
    Route::get('/categories',[\App\Http\Controllers\CategoriesController::class,'index'])->name('admin.categories');
    Route::get('/products', [\App\Http\Controllers\ProductController::class,'showAllProducts'])->name('admin.products');
    Route::delete('delete/{id}',[\App\Http\Controllers\CategoriesController::class,'delete'])->name('admin.delete');
    Route::get('/{id}/update', [\App\Http\Controllers\CategoriesController::class, 'edit'])->name('admin.edit');
    Route::patch('/{id}', [\App\Http\Controllers\CategoriesController::class,'update'])->name('update.category');
    Route::get('/create', [\App\Http\Controllers\ProductController::class,'createForm'])->name('admin.create.product');
    Route::post('/create', [\App\Http\Controllers\ProductController::class,'create'])->name('create.product');
    Route::get('/orders',[\App\Http\Controllers\OrderController::class, 'index'])->name('admin.orders');
    Route::post('/sent/{id}', [\App\Http\Controllers\OrderController::class,'sent'])->name('sent.order');
    Route::post('/delete/{id}', [\App\Http\Controllers\ProductController::class,'delete'])->name('delete.prod');
    Route::get('/see/{id}/total/{totalPrice}', [\App\Http\Controllers\OrderController::class,'show'])->name('see.order.details');
    Route::get('/edit/{id}', [\App\Http\Controllers\ProductController::class,'edit'])->name('edit.prod');
    Route::patch('/update/{id}', [\App\Http\Controllers\ProductController::class,'update'])->name('update.prod');
    }
);
Route::group(['middleware'=>'auth', 'prefix'=>'cart'], function (){
    Route::get('/',[\App\Http\Controllers\CartController::class,'index'])->name('cart');
    Route::post('/add/{id}',[\App\Http\Controllers\CartController::class,'add'])->name('add.cart');
    Route::post('/update/{id}',[\App\Http\Controllers\CartController::class,'edit'])->name('edit.cart');
    Route::post('/remove/{id}',[\App\Http\Controllers\CartController::class,'remove'])->name('remove.cart');
    Route::post('/order',[\App\Http\Controllers\CartController::class,'createOrder'])->name('createOrder.cart');
    }
);




