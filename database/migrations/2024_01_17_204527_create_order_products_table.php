<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('product_sku');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
            $table->foreign('product_sku')
                ->references('sku')
                ->on('products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};