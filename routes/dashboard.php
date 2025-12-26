<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/products', function () {
        return view('dashboard.products.index');
    })->name('dashboard.products.index');

    Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users.index');
    Route::patch('/dashboard/users/{user}/role', [UserController::class, 'updateRole'])->name('dashboard.users.update-role');
});
