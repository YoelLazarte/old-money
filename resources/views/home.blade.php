
@extends('layouts.main')


@section('title', 'Home')


@section('content')



<div id="default-carousel" class="relative w-full py-5 max-w-7xl mx-auto" data-carousel="slide">
  <div class="relative h-80 overflow-hidden rounded-lg md:h-96">
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ url('../img/banner-1.webp') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
      </div>
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ url('../img/banner-2.webp') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
      </div>
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="{{ url('../img/banner-3.webp') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
      </div>
  </div>
  <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse mb-4">
      <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
      <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
      <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
  </div>
  <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
          </svg>
          <span class="sr-only">Previous</span>
      </span>
  </button>
  <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <span class="sr-only">Next</span>
      </span>
  </button>
</div>




<div class="flex items-center mx-auto gap-x-8 flex-wrap max-w-4xl mt-6">
        <div class="mx-auto max-w-md order-2 md:order-1 mb-6">
            <h2 class="text-5xl mb-8 dark:text-stone-200 text-center lg:text-left"> Bienvenidos a <b>Old Money</b>! </h2>
                <p class="dark:text-stone-300 text-center lg:text-left">Descubre una nueva forma de vestir con estilo y elegancia. En Old Money, cada prenda está diseñada para quienes aprecian la calidad y la atemporalidad. Explora nuestra colección exclusiva y lleva tu estilo al siguiente nivel.
                <span class="font-bold mb-8">¡Compra ahora y transforma tu guardarropa!</span></p>

            <a href="/products/list" class="block mt-8 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Ver Productos</a>
            <!-- <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Continuar</button> -->
        </div>

  <div class="order-1 md:order-2 mx-auto mb-6">
    <div class="img">
          <img src="{{ url('../img/home.webp') }}" alt="OldMoney Productos" class="rounded-lg" />
    </div>
  </div>
</div>


@endsection
