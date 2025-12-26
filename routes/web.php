<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('frontend.index');
    })->name('home');

    Route::get('/categories', function () {
        return view('frontend.categories.index');
    })->name('cat.index');

    Route::get('/products', function () {
        return view('frontend.products.index');
    })->name('products.index');
});


require __DIR__.'/dashboard.php';
require __DIR__.'/auth.php';
