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

        // integraciones con mercadopago 

        $items = [];
        
        foreach($products as $product){
            $items[] = [
                'id' => $product-> product_id,
                'title' => $product-> name,
                'unit_price' => $product-> price,
                'quantity' => $product-> price,
            ];
        }

        try {
            
            MercadoPagoConfig::setAccessToken(config(mercadopago.access_token));

            // iniciamos nuestro "factory" de preferencias (cobro)

            $preferenceFactory = new PreferenceClient();

            $preference = $preferenceFactory->create([
                'items' => $items,
                // Configuramos las back_urls
                'back_urls' => [
                    'success' => route('test.mercadopago.successProcess'),
                    'pending' => route('test.mercadopago.pendingProcess'),
                    'failure' => route('test.mercadopago.failureProcess'),
                ],
                'auto_return' => 'approved',
            ]);

            
        
        } catch (\Throwable $e) {
            dd($e);
        }

        return view ('test.mercadopago', [
            'product' => $product,
            'preference' => $preference,
            // pasar la clave publica para poder agregarla en la conexion de JS
            'PublicKey' => config('mercadopago.public_key')
            
        ]);

    }

    
}
