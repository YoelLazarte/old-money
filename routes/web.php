<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, "home"])
 ->name('home');

// Route::get('/products', [App\Http\Controllers\HomeController::class, "products"])
//  ->name('products');

Route::get('/blog', [App\Http\Controllers\HomeController::class, "blog"])
 ->name('blog');


 Route::get('products/listado', [App\Http\Controllers\ProductController::class, "index"])
    ->name('products.index');