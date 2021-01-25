<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomepageController::class)->name('homepage');

Route::middleware(['auth:sanctum', 'role:*'])->group(function () {

    // Basket...
    Route::post('/basket', [BasketController::class, 'store'])->name('basket.store');
    Route::delete('/basket/{product}', [BasketController::class, 'destroy'])->name('basket.destroy');

    // Checkout...
    Route::apiResource('/checkout', CheckoutController::class)->only(['index', 'store']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Products...
    Route::apiResource('/products', ProductsController::class);

    // Orders...
    Route::apiResource('/orders', OrdersController::class);
});
