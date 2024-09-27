<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, "home"])
 ->name('home');

Route::get('/blog', [App\Http\Controllers\HomeController::class, "blog"])
 ->name('blog');


 Route::get('products/listado', [App\Http\Controllers\ProductController::class, "index"])
    ->name('products.index');

Route::get('product/{id}', [App\Http\Controllers\ProductController::class, "view"])
   ->name('products.view')
   ->whereNumber('id');


// Rutas para la autenticacion
   
 Route::get('/iniciar-sesion', [App\Http\Controllers\AuthController::class, "loginForm"])
   ->name('auth.login.form');
   
 Route::post('/iniciar-sesion', [App\Http\Controllers\AuthController::class , "loginProcess"])
   ->name('auth.login.process');
 
 Route::post('/cerrar-sesion', [App\Http\Controllers\AuthController::class , "logoutProcess"])
   ->name('auth.logout.process');
