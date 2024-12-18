@extends('layouts.main')


@section('title', 'Cerrar Sesión')

@section('content')

<h1 class="text-center dark:text-slate-100 text-3xl	my-8 font-medium">¿Desea cerrar la sesión?</h1>

<div class="max-w-lg mx-auto shadow-md bg-white rounded-md p-8">
    <p class="text-xl text-center mb-4"><b>Mail: </b> {{ Auth::user()->email }}</p>
    <div class="flex justify-between items-center p-6 space-x-4 ">
        <form action="{{ route('auth.logout.process') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-red-400 dark:focus:ring-red-300">
                Cerrar Sesión
            </button>
        </form>
    
        <a href="products/list" class="px-4 py-2 text-gray-900 dark:text-white bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-gray-500">
            Cancelar
        </a>
    </div>
    
</div>


@endsection