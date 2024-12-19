@extends('layouts.main')

@section('title', 'Pago Exitoso')

@section('content')
<h1 class="text-center dark:text-slate-100 text-3xl	my-8 font-medium">¡Pago Exitoso!</h1>

<div class="max-w-lg mx-auto shadow-md bg-white rounded-md p-8">
    <p class="text-xl text-center mb-4"><b>ID del Pago: </b> {{ $paymentId }}</p>
    <p class="text-xl text-center mb-4"><b>Estado: </b> {{ $status }}</p>
    <p class="text-xl text-center mb-4"><b>ID de la Orden: </b> {{ $merchantOrderId }}</p>
        <a href="{{ route('products.index') }}" class="px-4 py-2 flex justify-center text-white bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-red-400 dark:focus:ring-red-300">
            Volver
        </a>
    
</div>

@endsection