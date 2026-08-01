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
                'name' => 'Chocolate Cake',
                'price' => 85000,
                'stock' => 50,
                'image' => 'chocolate-cake.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 1,
                'name' => 'Red Velvet Cake',
                'price' => 90000,
                'stock' => 50,
                'image' => 'red-velvet.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'name' => 'Garlic Bread',
                'price' => 25000,
                'stock' => 80,
                'image' => 'garlic-bread.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'name' => 'Milk Bread',
                'price' => 22000,
                'stock' => 70,
                'image' => 'milk-bread.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'name' => 'Cheese Danish',
                'price' => 28000,
                'stock' => 60,
                'image' => 'cheese-danish.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'name' => 'Butter Croissant',
                'price' => 26000,
                'stock' => 60,
                'image' => 'butter-croissant.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 4,
                'name' => 'Chocolate Cookies',
                'price' => 18000,
                'stock' => 100,
                'image' => 'chocolate-cookies.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 4,
                'name' => 'Butter Cookies',
                'price' => 18000,
                'stock' => 100,
                'image' => 'butter-cookies.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}