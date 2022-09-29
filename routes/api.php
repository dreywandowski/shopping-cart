<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemsControllerApi;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentControllerApi;
use App\Http\Controllers\Api\ProfileControllerApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// authentication routes
Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware('auth:sanctum');
    });


// items routes
    Route::middleware('auth:sanctum')
     ->controller(ItemsControllerApi::class)->group(function () {
            Route::get('items', 'index');
            Route::post('upload', 'store');
            Route::put('update', 'update');
            Route::delete('delete', 'destroy');
    });


// payment routes
Route::middleware('auth:sanctum')
     ->controller(PaymentControllerApi::class)->group(function () {
            Route::post('paystack', 'paystack');
            Route::get('verifyPaystack', 'verifyPaystack');
            Route::post('flutterwave', 'flutterwave');
            Route::get('verifyFlutterwave', 'verifyFlutterwave');
            Route::post('remita', 'remita');
     });


     // profile routes
Route::middleware('auth:sanctum')
->controller(ProfileControllerApi::class)->group(function () {
       Route::get('orders', 'showOrders');
});



