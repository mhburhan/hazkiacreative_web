<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Pastikan model Product sudah ada

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan Faker yang sudah tersedia di Laravel
        $faker = \Faker\Factory::create();

        foreach (range(1, 20) as $index) {
            Product::create([
                'name' => $faker->words(3, true), // Nama produk, 3 kata
                'image' => $faker->imageUrl(640, 480, 'product', true, 'Faker'), // URL gambar produk
                'category_id' => $faker->numberBetween(1, 5), // ID kategori acak antara 1 dan 5
                'description' => $faker->paragraph, // Deskripsi produk
                'price' => $faker->numberBetween(10000, 1000000), // Harga produk
                'stock' => $faker->numberBetween(1, 100), // Stok produk
            ]);
        }
    }
}
