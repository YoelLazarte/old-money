<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;


class CartController extends Controller
{
    public function addToCart(Request $request, $productId){
        $user = auth()->user();
        $product = Product::findOrFail($productId);

        // Manejo de error si el producto no existe
        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404); 
        }


        // busca una orden activa del usuario, sino la crea
        $order = $user->orders()->firstOrCreate(['status' => 'in_cart']);

        // agregar un producto al carrito
        $order->products()->syncWithoutDetaching([
            $product->product_id => ['quantity' => 1]
        ]);

        return to_route('products.index')
            ->with('feedback.message', 'El producto fue agregado al carrito')
            ->with('feedback.color', 'indigo');
    }

    public function viewCart(){
        if (!auth()->check()) {
            return to_route('auth.login.form')
                ->with('feedback.message', 'Debes iniciar sesión para ver el carrito.')
                ->with('feedback.color', 'red');
        }

        $user = auth()->user();
        $order = $user->orders()->where('status', 'in_cart')->with('products')->first();

        return view('cart.cart', ['order' => $order]);
    }


    public function completeOrder(Request $request){
        $user = auth()->user();
        $order = $user->orders()->where('status', 'in_cart')->first();

        if(!$order){
            return redirect()->back()->with('error', 'No hay productos en el carrito');
        }

        // cambia el estado a completado y guardamos la fecha
        $order->update(['status' => 'completed']);

        return to_route('products.index')
            ->with('feedback.message', 'Compra completada')
            ->with('feedback.color', 'blue');
    }

    public function orderHistory(){
        $user = auth()->user();
        $order = $user->orders()->where('status', 'in_cart')->with('products')->get();

        return view('orders.history', ['orders' => $orders]);
        
    }
}
