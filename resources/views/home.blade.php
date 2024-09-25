
@extends('layouts.main')


@section('title', 'Home')


@section('content')


<div class="flex items-center mx-auto gap-x-8 flex-wrap max-w-4xl mt-6">
        <div class="mx-auto max-w-md order-2 md:order-1 mb-6">
            <h2 class="text-5xl mb-8 dark:text-stone-200 text-center lg:text-left"> Bienvenidos a <b>Old Money</b>! </h2>
                <p class="dark:text-stone-300 text-center lg:text-left">Descubre una nueva forma de vestir con estilo y elegancia. En Old Money, cada prenda está diseñada para quienes aprecian la calidad y la atemporalidad. Explora nuestra colección exclusiva y lleva tu estilo al siguiente nivel.
                <span class="font-bold">¡Compra ahora y transforma tu guardarropa!</span></p>

            <button type="button" class="mt-5 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Ver Mas</button>
            <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Continuar</button>
        </div>

  <div class="order-1 md:order-2 mx-auto mb-6">
    <div class="img">
          <img src="{{ url('../img/home.webp') }}" alt="OldMoney Productos" class="rounded-lg" />
    </div>
  </div>
</div>


@endsection
