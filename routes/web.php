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
Route::get('/shopping-cart/checkout', [App\Http\Controllers\ShopController::class, 'checkout']);
Route::get('/shopping-cart/checkout_logged', [App\Http\Controllers\ShopController::class, 'checkout_logged'])->middleware('auth');


Route::get('/shopping-cart/dashboard', [App\Http\Controllers\ProfileController::class, 'dashboard'])->middleware('auth');
Route::get('/shopping-cart/success', [App\Http\Controllers\ProfileController::class, 'success'])->middleware('auth');
Route::get('/shopping-cart/edit-profile', [App\Http\Controllers\ProfileController::class, 'edit'])->middleware('auth');
Route::post('/shopping-cart/update_details', [App\Http\Controllers\ProfileController::class, 'update'])->middleware('auth');
/*Route::post('/shopping-cart/handle_bills', [App\Http\Controllers\ProfileController::class, 'handle'])->middleware('auth')->name('flutterwave');
Route::post('/shopping-cart/paystack', [App\Http\Controllers\ProfileController::class, 'handlePaystk'])->middleware('auth')->name('paystack');

Route::post('https://api.paystack.co/transaction/initialize', [App\Http\Controllers\ProfileController::class, 'handlePaystk']);
Route::post('https://api.paystack.co/transaction/verify/{ref}', [App\Http\Controllers\ProfileController::class, 'handlePaystk']);*/


// Paystack route
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');

// Flutterwave routes
Route::post('/pay', [App\Http\Controllers\FlutterwaveController::class, 'initialize'])->name('pay');
// The callback url after a payment
Route::get('/rave/callback', [App\Http\Controllers\FlutterwaveController::class, 'callback'])->name('callback');


Route::get('/shopping-cart/thankyou', [App\Http\Controllers\ShopController::class, 'thanks'])->middleware('auth');
Route::get('/shopping-cart/{req}', [App\Http\Controllers\ShopController::class, 'delete']);




Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

