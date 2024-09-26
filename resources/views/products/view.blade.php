@extends ('layouts.main')
@section('title', $product->name)

@section('content')
<article class="max-w-[900px] m-auto">
<a href="#" class="my-8 w-full flex justify-center flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <img class="max-w-md object-cover rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{ $product->img }}" alt="">

    <div class=" flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $product->description }}</p>
            <div class=" flex-col">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${{ $product->price }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $product->size }}</p>
            </div>
    </div>
</a>
</article>


@endsection