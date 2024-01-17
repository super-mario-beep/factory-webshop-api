<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [ AuthController::class, 'login']);

Route::get('/products', [ ProductController::class, 'index' ]);
Route::get('/categories/{category}/products', [ CategoryController::class, 'products' ])->name('category.products');
Route::get('/products/filter', [ ProductController::class, 'filter' ]);
Route::get('/products/{identifier}', [ ProductController::class , 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/orders', [OrderController::class, 'create']);
    Route::get('/orders/{order_id}', [OrderController::class, 'show'])->name('orders.show');
});
