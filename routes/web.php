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
Route::get('/registration', [\App\Http\Controllers\RegistrationController::class, 'reg_v'])->name('reg_v');
Route::post('/save', [\App\Http\Controllers\RegistrationController::class, 'save'])->name('save_user');
Route::view('/login','auth/login')->name('login');
Route::post('/login',[\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\RegistrationController::class, 'logout'])->name('logout');
Route::group(['middleware'=>['auth'=>'admin'], 'prefix'=>'admin'],function (){
    Route::post('/home/create_category',[\App\Http\Controllers\AdminController::class,'create_category'])->name('create_category');
    Route::get('/categories',[\App\Http\Controllers\AdminController::class,'categories'])->name('admin.categories');
    Route::get('/products', [\App\Http\Controllers\AdminController::class,'showAllProducts'])->name('admin.products');
    Route::delete('/{id}',[\App\Http\Controllers\AdminController::class,'delete'])->name('admin.delete');
    Route::get('/categories',[\App\Http\Controllers\AdminController::class,'categories'])->name('admin.categories');
    Route::get('/{id}/update', [\App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/{id}', [\App\Http\Controllers\AdminController::class,'update'])->name('update.category');
    Route::get('/create', [\App\Http\Controllers\AdminController::class,'createform'])->name('admin.create.product');
    Route::post('/create', [\App\Http\Controllers\AdminController::class,'createproduct'])->name('createproduct');
    Route::get('/orders',[\App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders');
    Route::post('/sent/{id}', [\App\Http\Controllers\AdminOrderController::class,'sentOrder'])->middleware('auth')->name('sent.order');
    Route::post('/delete/{id}', [\App\Http\Controllers\AdminController::class,'deleteprod'])->name('delete.prod');
    Route::get('/see/{id}/total/{totalPrice}', [\App\Http\Controllers\AdminOrderController::class,'seeOrder'])->name('see.order.details');
    Route::get('/edit/{id}', [\App\Http\Controllers\AdminController::class,'editprod'])->name('edit.prod');
    Route::patch('/update/{id}', [\App\Http\Controllers\AdminController::class,'updateprod'])->name('update.prod');
    }
);
Route::group(['middleware'=>'auth', 'prefix'=>'cart'], function (){
    Route::get('/',[\App\Http\Controllers\CartController::class,'index'])->middleware('auth')->name('cart');
    Route::post('/add/{id}',[\App\Http\Controllers\CartController::class,'addCart'])->middleware('auth')->name('add.cart');
    Route::post('/update/{id}',[\App\Http\Controllers\CartController::class,'editCart'])->middleware('auth')->name('edit.cart');
    Route::post('/remove/{id}',[\App\Http\Controllers\CartController::class,'removeCart'])->middleware('auth')->name('remove.cart');
    Route::post('/order',[\App\Http\Controllers\CartController::class,'createOrder'])->middleware('auth')->name('createOrder.cart');
    }
);




