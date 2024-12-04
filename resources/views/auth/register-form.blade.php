
@extends('layouts.main')


@section('title', 'Registro')


@section('content')

<div class="w-full max-w-sm p-4 mx-auto my-8 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
    <form class="space-y-6" action="{{ route('auth.register.process') }}" method="POST">
        @csrf
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Registrate!</h5>
        
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ old('name') }}" />
            <p class="dark:text-red-300">
                @error('name')
                <span>{{ $message }}</span>
            @enderror
            </p>
        </div>

        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ old('email') }}" />
            <p class="dark:text-red-300">
                @error('email')
                <span>{{ $message }}</span>
            @enderror
            </p>
        </div>

        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
            <p class="dark:text-red-300">
                @error('password')
                <span>{{ $message }}</span>
            @enderror
            </p>
        </div>

        <div>
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
            <p class="dark:text-red-300">
                @error('password')
                <span>{{ $message }}</span>
            @enderror
            </p>
        </div>

        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrate</button>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
            ¿Ya tenés cuenta? <a href="{{ route('auth.login.form') }}"" class="text-blue-700 hover:underline dark:text-blue-500">Inicia sesion</a>
        </div>
    </form>
</div>



@endsection