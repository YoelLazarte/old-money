<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\RoleMiddleware;

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

        // Lógica para el middleware de rol de admin
        $middleware->redirectGuestsTo(function (Request $request, Closure $next) {
            // Verificar si el usuario está autenticado y tiene el rol de 'admin'
            if (!auth()->check() || auth()->user()->role !== 'admin') {
                // Redirigir con un mensaje si no es admin
                session()->flash('feedback.message', 'No tienes permiso para acceder a esta página.');
                session()->flash('feedback.color', 'red');
                return redirect()->route('home'); // Puedes redirigir a donde desees
            }

            return $next($request);
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
