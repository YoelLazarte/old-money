<?php

namespace App\Http\Controllers;

use App\Mail\ProductReserveConfirmation;
use App\Models\Product; //Revisar bien si la ruta es la correcta
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductReservationController extends Controller
{
    public function reservationProcess(int $id){
        Mail::to( auth()->user() )->send(new ProductReserveConfirmation(Product::findOrFail( $id ) ));

        return to_route('products.index')
            ->with('feedback.message', 'El producto se reservo con exito ');
    }

    public function printEmail(){
        return new ProductReserveConfirmation(Product::findOrFail( 1 ));
    }
}
