<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Mail\ProductReserveConfirmation;
use Illuminate\Support\Facades\Mail;

class OrderProcessController extends Controller
{
    public function finalizeAndReserve(Request $request)
    {
        $user = auth()->user();

        // **1. Finalizar Compra**
        $order = $user->orders()->where('status', 'in_cart')->first();

        if (!$order) {
            return redirect()->back()->with('error', 'No hay productos en el carrito.');
        }

        // Cambiar el estado de la orden a 'completed'
        $order->update(['status' => 'completed']);

        // **2. Reservar Productos**
        foreach ($order->products as $product) {
            // Enviar correo de confirmación para cada producto reservado
            Mail::to($user)->send(new ProductReserveConfirmation($product));
        }

        return to_route('products.index')
        ->with([
            'feedback.message' => 'Compra completada y productos reservados correctamente!.',
            'feedback.color' => 'green',
        ]);
    }
}
