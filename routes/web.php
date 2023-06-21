<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


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

Route::get('/login', function () {
    return view('login');
});
Route::get('/logout', function () {
    Session::forget('user');//use forget fior destroy the seeion
    return redirect('login');
});
Route::view('register','Register');
Route::view('login','login');
Route::get("search",[ProductController::class,'search']);
Route::post("/register",[UserController::class,"register"]);
Route::post("/login",[UserController::class,"login"]);
Route::get("/",[ProductController::class,"index"]);
Route::get("detail/{id}",[ProductController::class,"detail"]);  //here were getting product id
Route::post("/add_to_cart",[ProductController::class,"addToCart"]);
Route::get("cartlist",[ProductController::class,"cartList"]);
Route::get("removecart/{id}",[ProductController::class,"removeCart"]);
Route::get("ordernow",[ProductController::class,"orderNow"]);
Route::get("myorders",[ProductController::class,"myOrders"]);
Route::post("orderplace",[ProductController::class,"orderPlace"]);
Route::get("payonline",[ProductController::class,"onlinepay"]);
Route::post("make-order",[ProductController::class,"makeOrder"])->name('make.order');
Route::get("success",[ProductController::class,"success"])->name('success');
