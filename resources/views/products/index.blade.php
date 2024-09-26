@extends('layouts.main')


@section('title', 'Productos')


@section('content')

<h1 class="text-center dark:text-slate-100 text-3xl	my-8 font-medium">Productos</h1>



<div class="flex justify-center flex-wrap gap-8">
        
        @foreach($products as $product)
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="rounded-t-lg" src="{{ $product->img }}" alt="{{ $product->name }}" />
    </a>
    <div class="p-5">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $product->description }}</p>
        <div class="flex justify-between pe-4">
        <div class="flex content-around dark:text-slate-300 gap-8">
        <p class="font-bold text-lg">${{ $product->price }}</p>
        <p class="font-bold text-lg">{{ $product->size }}</p>
        </div>
        <a href="{{ route('products.view', ['id' => $product->product_id]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Ver detalles
             <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
        </div>
    </div>
</div>

@endforeach


</div>




@endsection