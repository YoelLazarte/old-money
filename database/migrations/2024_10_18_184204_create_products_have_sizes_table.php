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
        Schema::create('products_have_sizes', function (Blueprint $table) {
            $table->foreignId('product_fk')->constrained(table:'products', column:'product_id');
            $table->unsignedSmallInteger('size_fk');
            $table->foreign('size_fk')->references('size_id')->on('sizes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_have_sizes');
    }
};
