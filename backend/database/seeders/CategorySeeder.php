<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bread',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pastry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cookies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}