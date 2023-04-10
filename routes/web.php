<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/** Login route */
Auth::routes();

/** Dashboard route */
Route::get('/home', [HomeController::class, 'index'])->name('home');

/** category route resource */
Route::resource('/category', CategoryController::class)->except('show')->middleware('auth');

/** product route resource */
Route::resource('/product', ProductController::class)->except('show')->middleware('auth');

/** Cart route resource */
Route::controller(CartController::class)->middleware('auth')->group(function () {
    Route::get('/cart', 'show')->name('showCart');
    Route::get('/cart/invoice', 'invoice')->name('showInvoice');
});

/** offer route resource */
Route::resource('/offer', OfferController::class)->except(['show','edit','update'])->middleware('auth');

/** Cart Item route */
Route::resource('/CartItem', CartItemController::class)->except(['index','edit','create','show'])->middleware('auth');
