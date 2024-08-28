<?php

use App\Http\Controllers\AdminAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

// Kullanıcı işlemleri
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum', 'user'])->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
});


Route::middleware(['auth:sanctum', 'user'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Kullanıcıların siparişleri
    Route::get('/user/orders', [OrderController::class, 'userOrders']);
});

// Ürün listeleme herkes için açık
Route::get('products', [ProductController::class, 'index']);

// Yalnızca adminlerin erişebileceği ürün işlemleri
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);
});

// Admin işlemleri
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'logout']);
    Route::get('/admin', function (Request $request) {
        return $request->user();
    });

    // Adminlerin tüm siparişleri görmesi
    Route::get('/admin/orders', [OrderController::class, 'allOrders']);
});
