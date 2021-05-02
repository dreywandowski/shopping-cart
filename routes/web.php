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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index']);
Route::get('/shopping-cart/shop/{req}', [App\Http\Controllers\ShopController::class, 'shop']);
Route::get('/shopping-cart/shop-single/{req}', [App\Http\Controllers\ShopController::class, 'single']);
Route::get('/shopping-cart/contact', [App\Http\Controllers\ShopController::class, 'contact']);
Route::get('/shopping-cart/cart', [App\Http\Controllers\ShopController::class, 'cart']);
Route::get('/shopping-cart/{req}', [App\Http\Controllers\ShopController::class, 'delete']);
Route::get('/shopping-cart/checkout', [App\Http\Controllers\ShopController::class, 'checkout']);
Route::get('/shopping-cart/thankyou', [App\Http\Controllers\ShopController::class, 'thanks']);

Route::get('/shopping-cart/dashboard', [App\Http\Controllers\ProfileController::class, 'dashboard'])->middleware('auth');
Route::get('/shopping-cart/success', [App\Http\Controllers\ProfileController::class, 'success'])->middleware('auth');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

