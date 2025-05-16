<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseItemController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

// Redirect default /dashboard to inventory
Route::get('/dashboard', fn() => redirect()->route('inventory'))
    ->middleware('auth')
    ->name('dashboard');

// Redirect root to login page if not authenticated
Route::get('/', fn() => redirect()->route('login'));

// AUTHENTICATED ROUTES
Route::middleware('auth')->group(function () {

    // ✅ INVENTORY ACCESS
    Route::get('/inventory', [WarehouseItemController::class, 'index'])->name('inventory');

    // ✅ ADMIN ONLY: CREATE / EDIT / DELETE ITEMS
    Route::middleware('can:manage,App\Models\WarehouseItem')->group(function () {
        Route::get('/items/create', [WarehouseItemController::class, 'create'])->name('items.create');
        Route::post('/items', [WarehouseItemController::class, 'store'])->name('items.store');
        Route::get('/items/{item}/edit', [WarehouseItemController::class, 'edit'])->name('items.edit');
        Route::put('/items/{item}', [WarehouseItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [WarehouseItemController::class, 'destroy'])->name('items.destroy');
    });

    // ✅ USER: CHECKOUT
    Route::post('/items/{item}/checkout', [WarehouseItemController::class, 'checkout'])
        ->name('items.checkout')
        ->middleware('can:checkout,item');

    // ✅ CART FUNCTIONALITY
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{item}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // ✅ EXPORT INVENTORY
    Route::get('/items/export', [WarehouseItemController::class, 'export'])->name('items.export');

    // ✅ ACTIVITY LOGS PAGE (for all authenticated users — can restrict if needed)
    Route::get('/logs', function () {
        $logs = ActivityLog::latest()->with('user')->paginate(10);
        return view('logs.index', compact('logs'));
    })->name('logs.index');
});

require __DIR__.'/auth.php';
