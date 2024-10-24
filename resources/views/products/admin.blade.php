@extends('layouts.main')


@section('title', 'Admin de Productos')


@section('content')

@auth
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
                <!-- <th scope="col" class="px-6 py-3">
                    Available
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Weight
                </th> -->
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
                <img src="../img/{{ $product->img }}" alt="{{ $product->name }}">
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
                <!-- <td class="px-6 py-4">
                    3.0 lb.
                </td> -->
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


@endsection