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

    $order = $user->orders()->where('status', 'in_cart')->first();

    if (!$order) {
        return redirect()->back()->with('error', 'No hay productos en el carrito.');
    }

    $order->update(['status' => 'completed']);

    foreach ($order->products as $product) {
        Mail::to($user)->send(new ProductReserveConfirmation($product));
    }

    $newOrder = $user->orders()->create([
        'status' => 'in_cart',
    ]);

    return to_route('products.index')
        ->with([
            'feedback.message' => 'Compra completada y productos reservados correctamente!.',
            'feedback.color' => 'green',
        ]);
}

}
