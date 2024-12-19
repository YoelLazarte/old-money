<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Payments\MercadoPagoPayment;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;


class MercadoPagoController extends Controller
{
    public function show(){
        $products = Product::whereIn('product_id', [1,3])->get();

        $items = [];
        
        foreach($products as $product){
            $items[] = [
                'id' => $product->product_id,
                'title' => $product->name,
                'unit_price' => $product->price,
                // 'quantity' => $product-> price,
                'quantity' => 1,

            ];
        }

        try {
            
            // MercadoPagoConfig::setAccessToken(config(mercadopago.access_token));
            MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));


            // iniciamos nuestro "factory" de preferencias (cobro)

            $preferenceFactory = new PreferenceClient();

            $preference = $preferenceFactory->create([
                'items' => $items,
                // Configuramos las back_urls
                'back_urls' => [
                    'success' => route('mercadopago.successProcess'),
                    'pending' => route('mercadopago.pendingProcess'),
                    'failure' => route('mercadopago.failureProcess'),
                ],
                'auto_return' => 'approved',
            ]);
        } catch (\Throwable $e) {
            dd($e);
        }

        return view ('mercadopago', [
            
            'products' => $products,
            'preference' => $preference,
            // pasar la clave publica para poder agregarla en la conexion de JS
            'publicKey' => config('mercadopago.public_key')
            
        ]);
    }

    public function successProcess(Request $request)
{
    $paymentId = $request->query('payment_id'); 
    $status = $request->query('status');       
    $merchantOrderId = $request->query('merchant_order_id'); 

    return view('mercadopago.success', [
        'paymentId' => $paymentId,
        'status' => $status,
        'merchantOrderId' => $merchantOrderId,
    ]);
}

    public function pendingProcess(Request $request)
    {
        dd($request->query);
    }

    public function failureProcess(Request $request)
    {
        dd($request->query);
    }

}
