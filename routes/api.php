<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    //require authentication before login
    Route::get('products', [ProductsController::class, 'index']);

    Route::get('products/{id}/show', [ProductsController::class, 'show']);

    Route::post('product/add', [ProductsController::class, 'store']);

    Route::post('products/{id}/update', [ProductsController::class, 'update']);
    // Route::put('products/{id}/update', [ProductsController::class, 'update']);

    Route::delete('products/{id}/delete', [ProductsController::class, 'destroy']);

    //log out
    Route::post('logout', [AuthController::class, 'logout']);


});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
