<?php

use Illuminate\Support\Facades\Route;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;

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
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [App\Http\Controllers\ShopController::class, 'index']);
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index']);
Route::get('/shopping-cart/shop/{req}', [App\Http\Controllers\ShopController::class, 'shop']);
Route::get('/shopping-cart/shop-single/{req}', [App\Http\Controllers\ShopController::class, 'single'])->middleware('auth');
Route::get('/shopping-cart/contact', [App\Http\Controllers\ShopController::class, 'contact']);
Route::get('/shopping-cart/cart', [App\Http\Controllers\ShopController::class, 'cart']);
Route::get('/shopping-cart/checkout', [App\Http\Controllers\ShopController::class, 'checkout']);
Route::get('/shopping-cart/checkout_logged', [App\Http\Controllers\ShopController::class, 'checkout_logged'])->middleware('auth');
Route::get('/shopping-cart/apply', [App\Http\Controllers\ShopController::class, 'apply']);

Route::get('/shopping-cart/dashboard', [App\Http\Controllers\ProfileController::class, 'dashboard'])->middleware('auth');
Route::get('/shopping-cart/success', [App\Http\Controllers\ProfileController::class, 'success'])->middleware('auth');
Route::get('/shopping-cart/edit-profile', [App\Http\Controllers\ProfileController::class, 'edit'])->middleware('auth');
Route::post('/shopping-cart/update_details', [App\Http\Controllers\ProfileController::class, 'update'])->middleware('auth');
Route::post('/shopping-cart/paystack', [App\Http\Controllers\ProfileController::class, 'handlePaystk'])->middleware('auth')->name('paystack');
Route::get('/shopping-cart/remita_pay/{remita_code}', [App\Http\Controllers\ShopController::class, 'redirectRemita'])->middleware('auth');

Route::get('/shopping-cart/my-orders', [App\Http\Controllers\ProfileController::class, 'orders'])->middleware('auth')->name('orders');


Route::get('/shopping-cart/thankyou_flutter', [App\Http\Controllers\ShopController::class, 'thankFlutter']);
Route::get('/shopping-cart/thankyou_remita/{remita}', [App\Http\Controllers\ShopController::class, 'thanksRemita'])->middleware('auth');
Route::get('/shopping-cart/thankyou', [App\Http\Controllers\ShopController::class, 'thanks'])->middleware('auth');
//
//Route::get('/shopping-cart/mail-test', [App\Http\Controllers\MailController::class, 'sendMail']);
Route::get('/shopping-cart/mail-test', function (){
    $email_data = array(
        'title' => 'Testing from Adura-Shop',
        'body' => 'This is for testing purposes only',
    );
Mail::to('aduramimodamilare@gmail.com')->send(new Welcome($email_data));
dd('sent');
});

Route::get('/shopping-cart/admin', [App\Http\Controllers\ShopController::class, 'admin']);
Route::get('/shopping-cart/{req}', [App\Http\Controllers\ShopController::class, 'delete']);

// livewire
//Route::get('/shopping-cart/users/live', [App\Http\Livewire\LiveTable::class, 'render']);


Route::post('/shopping-cart/coupon', [App\Http\Controllers\ProfileController::class, 'applyCoupon'])->middleware('auth')->name('coupon');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

