<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/** category route resource **/
Route::resource('/category', CategoryController::class)->except('show');
/** product route resource **/
Route::resource('/product', ProductController::class)->except('show');
