@extends('layouts.main')


@section('title', 'Añadir Producto')


@section('content')


<section>
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Añadir un Producto</h2>
      
      @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-zinc-300 dark:text-red-400 w-fit mx-auto" role="alert">
                    Los datos del producto ingresados no son válidos. Volvé a intentar
                </div>
            @endif
      
      <form action="{{ route('products.create.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del Producto</label>
                  <input value="{{ old('name') }}" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribí el nombre del Producto" >
                  @error('name')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

              {{-- <div class="w-full">
                  <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imágen</label>
                  <input value="{{ old('img') }}" type="file" name="img" id="img" class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                  @error('img')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}

                <div class="w-full">
                    <label for="cover" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imágen</label>
                    <input type="file" name="cover" id="cover" class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    @error('cover')
                          <div class="text-red-400">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="w-full">
                    <label for="cover_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                    <input value="{{old('cover_description')}}" type="text" name="cover_description" id="cover_description" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    @error('cover_description')
                          <div class="text-red-400">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

              <div class="w-full">
                  <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                  <input value="{{ old('price') }}" type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                  @error('price')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
              <div>
                  <label for="sizes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Talle</label>
                  <div class="flex items-center gap-6 dark:text-white">
                    @foreach($sizes as $size)
                        <div>
                            <input class="dark:bg-gray-700 rounded-sm w-5 h-5" type="checkbox" name="size_id[]" value="{{ $size->size_id }}" @checked(in_array($size->size_id, old('size_id', [])))>
                            {{ $size->name }}
                        </div>
                    @endforeach
                </div>

                  </select>
                  @error('sizes')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror

                    
                </div>

                {{-- Agregado de clase --}}
                <div>
                    <label for="type_fk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                  <select value="{{ old('type') }}" id="type_fk" name="type_fk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($types as $type)
                        <option value="{{ $type->type_id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
    
                  </select>
                  @error('type')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
              <div class="sm:col-span-2">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                  <textarea name="description" id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribí la descripción del Producto">{{ old('description') }}</textarea>
                  @error('description')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
              </div>
          <button type="submit" class="flex w-fit me-auto items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
              Agregar Producto
          </button>
      </form>
  </div>
</section>


@endsection