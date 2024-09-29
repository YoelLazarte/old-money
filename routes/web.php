<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, "home"])
 ->name('home');

Route::get('/blog', [App\Http\Controllers\HomeController::class, "blog"])
 ->name('blog');


 Route::get('products/list', [App\Http\Controllers\ProductController::class, "index"])
    ->name('products.index');

Route::get('products/admin', [App\Http\Controllers\ProductController::class, "admin"])
->name('products.admin');

Route::get('product/{id}', [App\Http\Controllers\ProductController::class, "view"])
   ->name('products.view')
   ->whereNumber('id');



// Rutas para el CRUD
Route::get('products/publish', [App\Http\Controllers\ProductController::class, "createForm"])
  ->name('products.create.form')
  ->middleware('auth'); //Le indicamos que debe estar logueado si o si, sino, desde el middleware de app.php, lo enviamos al formulario de registro al usuario

Route::post('products/publish', [App\Http\Controllers\ProductController::class, "createProcess"])
  ->name('products.create.process')
  ->middleware('auth');

Route::get('products/{id}/edit', [App\Http\Controllers\ProductController::class, "editForm"])
  ->name('products.edit.form')
  ->whereNumber('id')
  ->middleware('auth');

Route::put('products/{id}/edit', [App\Http\Controllers\ProductController::class, "editProcess"])
  ->name('products.edit.process')
  ->whereNumber('id')
  ->middleware('auth');

Route::delete('products/{id}/eliminar', [App\Http\Controllers\ProductController::class, "deleteProcess"])
  ->name('products.delete.process')
  ->whereNumber('id')
  ->middleware('auth');

  //¿Agregar una vista para confirmar delete?


// Rutas para la autenticacion
   
 Route::get('/iniciar-sesion', [App\Http\Controllers\AuthController::class, "loginForm"])
   ->name('auth.login.form');
   
 Route::post('/iniciar-sesion', [App\Http\Controllers\AuthController::class , "loginProcess"])
   ->name('auth.login.process');
 
 Route::post('/cerrar-sesion', [App\Http\Controllers\AuthController::class , "logoutProcess"])
   ->name('auth.logout.process');
