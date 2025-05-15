<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseItemController;
use App\Http\Controllers\CartController;

// Dashboard redirect
Route::get('/dashboard', fn() => redirect()->route('inventory'))
     ->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    // Inventory listing
    Route::get('/', [WarehouseItemController::class, 'index'])
         ->name('inventory');

    // Admin CRUD
    Route::middleware('can:manage,App\Models\WarehouseItem')->group(function () {
        Route::get('items/create', [WarehouseItemController::class, 'create'])->name('items.create');
        Route::post('items', [WarehouseItemController::class, 'store'])->name('items.store');
        Route::get('items/{item}/edit', [WarehouseItemController::class, 'edit'])->name('items.edit');
        Route::put('items/{item}', [WarehouseItemController::class, 'update'])->name('items.update');
        Route::delete('items/{item}', [WarehouseItemController::class, 'destroy'])->name('items.destroy');
    });

    // Direct checkout
    Route::post('items/{item}/checkout', [WarehouseItemController::class, 'checkout'])
         ->name('items.checkout')
         ->middleware('can:checkout,item');

    // Cart routes
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/add/{item}', [CartController::class, 'add'])->name('cart.add');
    Route::post('cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

require __DIR__.'/auth.php';
