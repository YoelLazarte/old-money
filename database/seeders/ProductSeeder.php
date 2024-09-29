<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File; 
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lee el archivo JSON y decodifícalo
        $json = File::get(base_path('resources/data/products.json'));
        $products = json_decode($json, true);

        // Verificar que la decodificación fue correcta y se tiene un array de productos
        if (is_null($products) || !is_array($products)) {
            $this->command->error("Error al decodificar el JSON.");
            return;
        }

        // Recorrer cada producto del JSON e insertarlo en la base de datos
        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'size' => $product['size'],
                'img' => $product['img'],
            ]);
        }

        $this->command->info('Productos cargados correctamente desde el JSON.');

    }
}
