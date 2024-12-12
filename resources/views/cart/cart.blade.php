@extends('layouts.main')

@section('title', 'Carrito')

@section('content')

<div class="h-screen py-8 ">
    <div class="container mx-auto px-4">
        <div class="flex flex-col 2xl:flex-row gap-4">
            <div class="2xl:w-3/4">
                <div class="dark:text-white mb-4">
                    @if ($order && $order->products->count())
                    <form action="{{ route('cart.update') }}" method="POST" class="p-6 rounded-lg shadow-md bg-white ">
                        @csrf
                    
                        <h1 class="text-2xl font-bold mb-4 dark:text-black">Tu Carrito</h1>
                    
                        <table class="w-full table-auto border-collapse dark:text-black">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2 text-left">Producto</th>
                                    <th class="py-2 text-left">Precio/Unidad</th>
                                    <th class="py-2 text-left">Cantidad</th>
                                    <th class="py-2 text-left">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($order->products as $product)
                                    @php
                                        $subtotal = $product->price * $product->pivot->quantity;
                                        $total += $subtotal;
                                    @endphp
                                    <tr class="border-b">
                                        <td class="py-4 flex items-center">
                                            <img src="{{ Storage::url('covers/' . $product->cover) }}" 
                                                 alt="{{ $product->cover_description }}" 
                                                 class="h-16 w-16 rounded-lg mr-4 object-cover">
                                            <span class="text-lg font-medium">{{ $product->name }}</span>
                                        </td>
                    
                                        <td class="py-4 text-gray-700 font-semibold">
                                            ${{ number_format($product->price, 2) }}
                                        </td>
                    
                                        <td class="py-4">
                                            <input type="number" 
                                                   name="quantities[{{ $product->product_id }}]" 
                                                   value="{{ $product->pivot->quantity }}" 
                                                   min="0" 
                                                   class="w-16 border border-gray-300 rounded text-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </td>
                    
                                        <td class="py-4 text-gray-700 font-semibold">
                                            ${{ number_format($subtotal, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                        <div class="flex justify-between items-center mt-6">
                            <span class="text-xl font-bold">Total: ${{ number_format($total, 2) }}</span>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-md transition duration-200">
                                Actualizar carrito
                            </button>
                        </div>
                    </form>
                    
                    
                    
                </div>
            </div>
            <div class="2xl:w-1/4">
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

