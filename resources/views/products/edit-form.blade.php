@extends('layouts.main')


@section('title', 'Editar '.e($product->name))


@section('content')


<section class=" mt-8">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar <span class="bg-stone-100 dark:bg-zinc-700 px-2 rounded-md">{{ $product->name }}</span></h2>
      @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-zinc-300 dark:text-red-400 w-fit mx-auto" role="alert">
                    Hay algún error en los datos del formulario. Volver a intentar
                </div>
            @endif
      <form action="{{ route('products.edit.process', ['id' => $product->product_id]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf


                {{-- <div class="w-full mb-8">
                    <img class="mx-auto w-72 rounded-lg" src="../../img/{{ $product->img }}" alt="{{ $product->name }}">
                  <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imágen</label>
                  <input value="{{ old('img') }}" type="file" name="img" id="img" class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                  @error('img')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}

                <div class="w-full mb-8">
                    <img class="w-46 mx-auto" src="{{ Storage::url('covers/' . $product->cover) }}" alt="{{ $product->cover_description }}" />
                  <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imágen</label>
                  <input value="{{ old('cover') }}" type="file" name="cover" id="cover" class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                  @error('cover')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="w-full mb-8">
                  <label for="cover_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                  <input value="{{ old('cover_description', $product->cover_description) }}" type="text" name="cover_description" id="cover_description" class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                  @error('cover_description')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                  <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('name', $product->name) }}" required="">
                  @error('name')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
              </div>
              
              <div class="w-full">
                  <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                  <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="$2999" value="{{ old('price', $product->price) }}" required="">
                  @error('price')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
              </div>

              <div>
                <label for="sizes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Talle</label>
                  @foreach($sizes as $size)
                      <input class="dark:text-white" type="checkbox" name="size_id[]" value="{{ $size->size_id }}" @checked(in_array($size->size_id, old('size_id', [])))>
                          {{ $size->name }}
                  @endforeach

                </select>
                @error('sizes')
                      <div class="text-red-400">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div>
                <label for="type_fk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
              <select value="{{ old('type') }}" id="type_fk" name="type_fk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach($types as $type)
                    <option value="{{ $type->type_id }}" @selected($type->type_id == old('type_fk', $product->type_fk))>
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
                  <textarea name="description" id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                  @error('description')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
              </div>
          </div>
          <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
              Editar Producto
          </button>
      </form>
  </div>
</section>


@endsection