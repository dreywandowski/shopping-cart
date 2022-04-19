<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemsControllerApi;
use App\Http\Controllers\Api\AuthController;

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
Route::
controller(AuthController::class)->group(function () {
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
    Route::get('delete', [App\Http\Controllers\Api\PaymentControllerApi::class, 'index']);

