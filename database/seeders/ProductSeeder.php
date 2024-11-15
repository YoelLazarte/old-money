<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\File; 
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lee el archivo JSON y lo decodifica
        $json = File::get(base_path('resources/data/products.json'));
        $products = json_decode($json, true);

        // Verifica que la decodificación fue correcta y tiene un array de productos
        if (is_null($products) || !is_array($products)) {
            $this->command->error("Error al decodificar el JSON.");
            return;
        }

        // Recorrer cada producto del JSON e insertarlo en la base de datos
        foreach ($products as $product) {
            // Crea el producto
            $newProduct = Product::create([
                'type_fk' => $product['type_fk'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'cover' => $product['cover'],
                'cover_description' => $product['cover_description'],
            ]);

            // Verifica si hay tamaños asociados
            if (isset($product['size_fk']) && is_array($product['size_fk'])) {
                foreach ($product['size_fk'] as $sizeId) {
                    DB::table('products_have_sizes')->insert([
                        'product_fk' => $newProduct->product_id, // Usa el ID del producto recién creado
                        'size_fk' => $sizeId,
                    ]);
                }
            }
        }

        // Aca agregamos la table size para hacer la relacion muchos a muchos
        // DB::table('products_have_sizes')->insert([
        //     ['product_fk' => 1, 'size_fk' => 1],
        //     ['product_fk' => 2, 'size_fk' => 2],
        //     ['product_fk' => 3, 'size_fk' => 1],
        // ]);

    }

}
