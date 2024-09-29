<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //configurar la URL donde queremos redireccionar a los usuarios no autenticados que tratan de ingresar a rutas protegidas 
        $middleware->redirectGuestsTo(function(Request $request){
            session()->flash('feedback.message', 'Se requiere iniciar sesión');
            session()->flash('feedback.color', 'red');
            return route('auth.login.form');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
