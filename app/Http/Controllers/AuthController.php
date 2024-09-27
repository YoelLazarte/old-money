<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login-form');
    }

    public function loginProcess(Request $request){
        // dd($request->all());

        // Maneras de llegar a la autenticacion
        // auth() , \Auth,  \Illuminate\Support\Facades\Auth 

        // Metodo: "attempt()" = es el que vamos a utilizar 

        // las credenciales para el attempt deben ser un arreglo con al menos 2 claves, 
        // - 1 clave para el password que por defecto debe llamarse password
        // - una o mas claves para buscar el registro del usuario en la base de datos 


        $credentials = $request->only(['email', 'password']);
            if(!auth()->attempt($credentials)){
                // Retornar al usuario a la pagina que vino
                // back() retorna al usuario a la url de la cual provino, solo lo hace si el header tiene "HTTP_REFER"
                // withinput() agrega en la sesion los datos delform de la peticion, para poder usarse con la funcion old()
                return redirect()
                    ->back(fallback: route('auth.login.form'))
                    ->withInput()
                    ->with('feedback.message', 'Las credenciales son incorrectas')
                    ->with('feedback.color', 'red');


            }
            return redirect()
                ->route('products.index')
                ->with('feedback.message', 'Inicio exitoso')
                ->with('feedback.color', 'blue');

    }

    public function logoutProcess(Request $request){
        // cerramos la sesion
        auth()->logout();

        // invalidamos la sesion,creamos otra regeneramosel token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.login.form')
            ->with('feedback.message', 'Cierre de sesion exitoso')
            ->with('feedback.color', 'blue');
    
    
    }


}
