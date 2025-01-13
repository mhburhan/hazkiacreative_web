<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID pesanan (auto-increment)
            $table->string('name'); // Nama pemesan
            $table->text('address'); // Alamat pemesan
            $table->string('phone'); // Nomor telepon pemesan
            $table->decimal('total_amount', 10, 2); // Total jumlah pesanan
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending'); 
            $table->string('payment_method'); // Menambahkan kolom untuk metode pembayaran
            $table->string('payment_proof')->nullable(); // Status pesanan (misalnya: pending, completed, canceled)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}