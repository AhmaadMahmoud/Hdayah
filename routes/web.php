<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\GiftController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::get('/categories/{category}', function (Category $category) {
        $products = Product::with(['images', 'category'])
            ->where('category_id', $category->id)
            ->latest()
            ->get();

        return view('frontend.categories.index', compact('category', 'products'));
    })->name('categories.show');


    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/gift', [GiftController::class, 'index'])->name('gifts.index');
});

require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
