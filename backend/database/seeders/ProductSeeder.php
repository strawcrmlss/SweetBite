<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'category_id' => 1,
                'name' => 'Rice Bowl Ayam Crispy',
                'price' => 22000,
                'stock' => 100,
                'image' => 'ayam-crispy.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Rice Bowl Teriyaki',
                'price' => 24000,
                'stock' => 100,
                'image' => 'teriyaki.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Rice Bowl Geprek',
                'price' => 23000,
                'stock' => 100,
                'image' => 'geprek.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Thai Tea',
                'price' => 12000,
                'stock' => 100,
                'image' => 'thaitea.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Kentang Goreng',
                'price' => 15000,
                'stock' => 100,
                'image' => 'kentang.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}