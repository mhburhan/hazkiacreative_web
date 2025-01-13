<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambah kategori secara manual
        Category::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik',
            'description' => 'Kategori untuk produk-produk elektronik seperti laptop, ponsel, dan aksesoris lainnya.',
        ]);

        Category::create([
            'name' => 'Pakaian',
            'slug' => 'pakaian',
            'description' => 'Kategori untuk produk pakaian pria dan wanita, termasuk aksesoris dan sepatu.',
        ]);

        Category::create([
            'name' => 'Peralatan Rumah Tangga',
            'slug' => 'peralatan-rumah-tangga',
            'description' => 'Kategori untuk produk-produk yang digunakan di rumah, seperti perabot dan alat elektronik rumah tangga.',
        ]);

        Category::create([
            'name' => 'Olahraga',
            'slug' => 'olahraga',
            'description' => 'Kategori untuk perlengkapan olahraga seperti sepatu olahraga, baju olahraga, dan alat fitnes.',
        ]);

        Category::create([
            'name' => 'Makanan & Minuman',
            'slug' => 'makanan-minuman',
            'description' => 'Kategori untuk produk makanan dan minuman berbagai jenis.',
        ]);
    }
}
