<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Api\AuthController;

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

 Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);


Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// items routes
Route::get('items', [App\Http\Controllers\Api\ItemsControllerApi::class, 'index']);
Route::post('upload', [App\Http\Controllers\Api\ItemsControllerApi::class, 'store']);
Route::get('update', [App\Http\Controllers\Api\ItemsControllerApi::class, 'update'])->middleware('auth:api');
Route::get('delete', [App\Http\Controllers\Api\ItemsControllerApi::class, 'destroy'])->middleware('auth:api');

// payment routes
Route::get('delete', [App\Http\Controllers\Api\PaymentControllerApi::class, 'index'])->middleware('auth:api');
