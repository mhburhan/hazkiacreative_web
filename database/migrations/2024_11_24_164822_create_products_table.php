<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Nama Produk
            $table->string('image')->nullable(); // Gambar Produk (URL atau Path)
            $table->foreignId('category_id'); // Kategori Produk
            $table->text('description')->nullable(); // Deskripsi Produk
            $table->decimal('price', 10, 2); // Harga Produk
            $table->integer('stock'); // Stok Produk
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
