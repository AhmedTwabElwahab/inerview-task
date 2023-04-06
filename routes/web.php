<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/** Login route */
Auth::routes();

/** Dashboard route */
Route::get('/home', [HomeController::class, 'index'])->name('home');

/** category route resource */
Route::resource('/category', CategoryController::class)->except('show');

/** product route resource */
Route::resource('/product', ProductController::class)->except('show');

/** Cart route resource */
Route::resource('/cart', CartController::class)->except('show');

/** offer route resource */
Route::resource('/offer', CartController::class)->except('show');
