<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['in_cart', 'completed'])->default('in_cart');
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Clave foránea a la tabla orders
            $table->unsignedBigInteger('product_id'); // Define la columna product_id
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade'); // Referencia a product_id en la tabla products
            $table->integer('quantity')->default(1); // Cantidad del producto
            $table->timestamps(); // Timestamps
        });
        


        // Schema::create('order_product', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Clave foránea a la tabla 'orders'
        //     $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Clave foránea a la tabla 'products'
        //     $table->integer('quantity')->default(1);  // Cantidad del producto
        //     $table->timestamps();  // Marca de tiempo para created_at y updated_at
        // });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product'); // Eliminar la tabla pivot
        Schema::dropIfExists('orders'); // Eliminar la tabla 'orders'
    }
};
