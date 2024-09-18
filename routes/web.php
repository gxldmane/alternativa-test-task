<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/{id}', 'show')->name('products.show');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'show')->name('cart.index');
    Route::post('/cart/add/{productId}', 'addToCart')->name('cart.add');
    Route::post('/cart/update/{productId}', 'update')->name('cart.update');
    Route::post('/cart/remove/{productId}', 'removeFromCart')->name('cart.remove');
    Route::post('/cart/clear', 'clear')->name('cart.clear');
});

Route::controller(OrderController::class)->group(function () {
    Route::post('/checkout', 'store')->name('checkout.place');
    Route::get('/checkout', 'show')->name('checkout');
});

Route::get('/order-success', function () {
    return view('checkout.success');
})->name('order.success');
