@extends('layouts.main')

@section('title', 'Carrito')

@section('content')

<div class="h-screen py-8 ">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4 dark:text-white">Tu carrito</h1>
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="dark:text-white mb-4">
                    @if ($order && $order->products->count())
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left font-semibold">Producto</th>
                                <th class="text-left font-semibold">Precio</th>
                                <th class="text-left font-semibold">Cantidad</th>
                                <th class="text-left font-semibold">Subtotal</th>
                            </tr>
                            
                        </thead>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($order->products as $product)
                        @php
                            $subtotal = $product->price * 1;
                            $total += $subtotal;
                        @endphp
                        <tbody>
                            <tr>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img class="h-20 w-20 mr-4" src="{{ Storage::url('covers/' . $product->cover) }}" alt="{{ $product->cover_description }}">
                                        <span class="font-semibold">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4">${{ $product->price }}</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <button class="border rounded-md py-2 px-4 mr-2">-</button>
                                        <span class="text-center w-8">2</span>
                                        <button class="border rounded-md py-2 px-4 ml-2">+</button>
                                    </div>
                                </td>
                                <td class="py-4">${{ number_format($subtotal, 2) }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    
                </div>
            </div>
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Resumen</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    {{-- <div class="flex justify-between mb-2">
                        <span>Taxes</span>
                        <span>$1.99</span>
                    </div> --}}
                    <div class="flex justify-between mb-2">
                        <span>Envio</span>
                        <span>$0.00</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold">{{ number_format($total, 2) }}</span>
                    </div>
                    <div id="mercadopago-button"></div>
                    <script src="https://sdk.mercadopago.com/js/v2"></script>
                    <script>
                        const mp = new MercadoPago("{{ $publicKey }}");
                        mp.bricks().create('wallet', 'mercadopago-button', {
                            initialization: {
                                preferenceId: "{{ $preference->id }}",
                            }
                        });
                        </script>
                        
                        {{-- <form action="{{ route('cart.finalize_reserve') }}" method="post">
                        @csrf
                        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Finalizar Compra</button> --}}
                    {{-- </form> --}}
                    @else
                        <p>No tenés productos en tu carrito.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection