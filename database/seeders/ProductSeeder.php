<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Semen Tiga Roda',
            'category' => 'Material Dasar',
            'stock' => 150,
            'price' => 54000,
            'image' => 'images/products/semen.jpg'
        ]);

        Product::create([
            'name' => 'Bata Merah',
            'category' => 'Material Dasar',
            'stock' => 300,
            'price' => 1200,
            'image' => 'images/products/bata.jpg'
        ]);

        Product::create([
            'name' => 'Kabel Listrik',
            'category' => 'Listrik',
            'stock' => 300,
            'price' => 1200,
            'image' => 'images/products/listrik.jpg'
        ]);
    }
}
