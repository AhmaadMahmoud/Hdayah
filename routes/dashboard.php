<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\GiftOptionController;
use App\Http\Controllers\Dashboard\GiftOptionTypeController;
use App\Http\Controllers\Dashboard\FilterController;
use App\Models\Order;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        $orders = Order::with(['product', 'user'])
            ->latest()
            ->paginate(10);

        $stats = [
            'orders_count' => Order::count(),
            'revenue' => Order::sum('total'),
            'cash_count' => Order::where('payment_method', 'cash')->count(),
            'card_count' => Order::where('payment_method', 'card')->count(),
        ];

        return view('dashboard.index', compact('orders', 'stats'));
    })->name('dashboard');

    Route::get('/dashboard/products', [ProductController::class, 'index'])->name('dashboard.products.index');
    Route::post('/dashboard/products', [ProductController::class, 'store'])->name('dashboard.products.store');
    Route::patch('/dashboard/products/{product}', [ProductController::class, 'update'])->name('dashboard.products.update');
    Route::delete('/dashboard/products/{product}', [ProductController::class, 'destroy'])->name('dashboard.products.destroy');

    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories.index');
    Route::post('/dashboard/categories', [CategoryController::class, 'store'])->name('dashboard.categories.store');
    Route::patch('/dashboard/categories/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::delete('/dashboard/categories/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');

    Route::get('/dashboard/gifts', [GiftOptionController::class, 'index'])->name('dashboard.gifts.index');
    Route::post('/dashboard/gifts', [GiftOptionController::class, 'store'])->name('dashboard.gifts.store');
    Route::patch('/dashboard/gifts/{giftOption}', [GiftOptionController::class, 'update'])->name('dashboard.gifts.update');
    Route::delete('/dashboard/gifts/{giftOption}', [GiftOptionController::class, 'destroy'])->name('dashboard.gifts.destroy');
    Route::post('/dashboard/gift-types', [GiftOptionTypeController::class, 'store'])->name('dashboard.gift-types.store');
    Route::patch('/dashboard/gift-types/{giftOptionType}', [GiftOptionTypeController::class, 'update'])->name('dashboard.gift-types.update');
    Route::delete('/dashboard/gift-types/{giftOptionType}', [GiftOptionTypeController::class, 'destroy'])->name('dashboard.gift-types.destroy');

    Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users.index');
    Route::patch('/dashboard/users/{user}/role', [UserController::class, 'updateRole'])->name('dashboard.users.update-role');

    Route::get('/dashboard/filters', [FilterController::class, 'edit'])->name('dashboard.filters.edit');
    Route::post('/dashboard/filters', [FilterController::class, 'update'])->name('dashboard.filters.update');
});
