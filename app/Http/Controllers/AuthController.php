<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


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

    public function registerForm(){
        return view('auth.register-form');
    }

    public function registerProccess(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('auth.login.form')
            ->with('feedback.message', 'Usuario registrado con éxito. Por favor, inicie sesión.')
            ->with('feedback.color', 'green');
    }


}
