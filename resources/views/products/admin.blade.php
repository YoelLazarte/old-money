@extends('layouts.main')


@section('title', 'Admin de Productos')


@section('content')

@auth
<div class="flex justify-center ">
    <div class="rounded-md shadow-sm mt-10" role="group">
        <a href="{{ route('products.admin') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            <svg class="w-3 h-3 me-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z"/>
            </svg>
            Productos
        </a>
    
        <a href="{{ route('products.users') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-r-lg text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            <svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
            </svg>
            Usuarios
        </a>
    </div>      
</div>
  


    <a href="{{ route('products.create.form') }}" class="flex w-fit ms-auto items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
        Añadir Producto
    </a>
@endauth

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Imágen
                </th>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Talle
                </th>
                <th scope="col" class="px-6 py-3">
                    Descripción
                </th>
                <th scope="col" class="px-6 py-3">
                    Precio
                </th>
                @auth
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)

            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <img class="w-full" src="{{ Storage::url('covers/' . $product->cover) }}" alt="{{ $product->cover_description }}" />
                </th>
                <td class="px-6 py-4">
                {{ $product->product_id }}
                </td>
                <td class="px-6 py-4">
                {{ $product->name }}
                </td>
                <td class="px-6 py-4">
                    @foreach ($product->sizes as $size)
                    <span>{{ $size->name }}</span>
                @endforeach
                </td>
                <td class="px-6 py-4">
                {{ $product->description }}
                </td>
                <td class="px-6 py-4">
                ${{ $product->price }}
                </td>
                @auth
                <td >
                    <a href="{{ route('products.edit.form',['id' => $product->product_id])}}" class="block text-center font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                    <form class="block text-center" action="{{ route('products.delete.process',['id' => $product->product_id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class=" text-center font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('¿Desea borrrar el producto?')" value="Borrar"/>
                    </form>
                </td>
                @endauth
            </tr>

            @endforeach
            </tbody>
    </table>
</div>
<div class="max-w-xl gap-8 mx-auto">
    {{  $products->links() }}
</div>


@endsection