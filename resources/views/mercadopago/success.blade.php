@extends('layouts.app')

@section('title', 'Pago Exitoso')

@section('content')
<h1 class="text-center dark:text-slate-100 text-3xl	my-8 font-medium">¡Pago Exitoso!</h1>

<div class="max-w-lg mx-auto shadow-md bg-white rounded-md p-8">
    <p class="text-xl text-center mb-4"><b>ID del Pago: </b> {{ $paymentId }}</p>
    <p class="text-xl text-center mb-4"><b>Estado: </b> {{ $status }}</p>
    <p class="text-xl text-center mb-4"><b>ID de la Orden: </b> {{ $merchantOrderId }}</p>
        <a href="{{ route('products.index') }}" class="px-4 py-2 text-gray-900 dark:text-white bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-gray-500">
            Cancelar
        </a>
    
</div>

@endsection