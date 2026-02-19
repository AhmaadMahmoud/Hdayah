<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\GiftController;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Route;

// صفحات متاحة للجميع (بدون تسجيل دخول)
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// السلة والهدايا تتطلب تسجيل دخول
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/products/{product}/gift', [GiftController::class, 'index'])->name('gifts.index');
    Route::post('/products/{product}/gift/checkout', [GiftController::class, 'checkout'])->name('gifts.checkout');
    Route::post('/products/{product}/gift/pay', [GiftController::class, 'pay'])->name('gifts.pay');
});

require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
