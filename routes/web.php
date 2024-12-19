<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MercadoPagoController;


Route::get('/', [App\Http\Controllers\HomeController::class, "home"])
 ->name('home');

Route::get('/blog', [App\Http\Controllers\HomeController::class, "blog"])
 ->name('blog');
 
Route::get('/close-session', [App\Http\Controllers\HomeController::class, "closeSession"])
 ->name('close-session');

Route::get('product/{id}', [App\Http\Controllers\ProductController::class, "view"])
 ->name('products.view')
 ->whereNumber('id');
 
Route::get('products/list', [App\Http\Controllers\ProductController::class, "index"])
  ->name('products.index');

Route::get('cart/cart', [App\Http\Controllers\CartController::class, "viewCart"])
  ->name('cart.view');





Route::get('products/admin', [App\Http\Controllers\ProductController::class, "admin"])
  ->name('products.admin')
  ->middleware(['auth', RoleMiddleware::class]);

Route::get('products/users', [App\Http\Controllers\UserController::class, "users"])
  ->name('products.users')
  ->middleware(['auth', RoleMiddleware::class]);




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

Route::get('/register', [App\Http\Controllers\AuthController::class , "registerForm"])
    ->name('auth.register.form');

Route::post('/register', [App\Http\Controllers\AuthController::class , "registerProccess"])
    ->name('auth.register.process');

Route::post('/cerrar-sesion', [App\Http\Controllers\AuthController::class , "logoutProcess"])
    ->name('auth.logout.process');




// Rutas del servicio de Mail

Route::post('/products/{id}/reservar', [App\Http\Controllers\ProductReservationController::class , "reservationProcess"])
   ->name('products.reservation.process');

Route::get('/tests/emails/reserva-producto', [App\Http\Controllers\ProductReservationController::class , "printEmail"])
   ->name('products.reservation.test');



//  Rutas de pago

Route::get('mercadopago', [\App\Http\Controllers\MercadoPagoController::class, 'show'])
  ->name('mercadopago.show');

Route::get('mercadopago/success', [\App\Http\Controllers\MercadoPagoController::class, 'successProcess'])
  ->name('mercadopago.successProcess');

Route::get('mercadopago/pending', [\App\Http\Controllers\MercadoPagoController::class, 'pendingProcess'])
  ->name('mercadopago.pendingProcess');
  
Route::get('mercadopago/failure', [\App\Http\Controllers\MercadoPagoController::class, 'failureProcess'])
  ->name('mercadopago.failureProcess');


// Rutas carrito

Route::get('cart', [\App\Http\Controllers\CartController::class, 'viewCart'])
  ->name('cart.view');

Route::post('cart/add/{id}', [\App\Http\Controllers\CartController::class, 'addToCart'])
  ->name('cart.add');

Route::post('cart/complete', [\App\Http\Controllers\CartController::class, 'completeOrder'])
  ->name('cart.complete');

Route::post('cart/finalizar-reserva', [\App\Http\Controllers\OrderProcessController::class, 'finalizeAndReserve'])
->name('cart.finalize_reserve');

Route::get('orders/history', [\App\Http\Controllers\CartController::class, 'orderHistory'])
  ->name('orders.history');

  Route::post('cart/update', [\App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');


// Ruta para cambiar roles
Route::put('/admin/update-role/{id}', [AdminController::class, 'updateRole'])->name('admin.updateRole');


//Success de MercadoPago

Route::get('/mercadopago/success', [MercadoPagoController::class, 'successProcess'])
  ->name('mercadopago.successProcess');

  