<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id'); // Menghubungkan dengan tabel orders
            $table->foreignId('product_id'); // Menghubungkan dengan tabel products
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Menyimpan harga produk
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}