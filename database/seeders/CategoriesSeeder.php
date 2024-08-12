<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Laptops', 'slug' => Str::slug('Laptops'), 'image' => 'categories/laptops.png'],
            ['name' => 'Smartphones', 'slug' => Str::slug('Smartphones'), 'image' => 'categories/smartphones.webp'],
            ['name' => 'Tablets', 'slug' => Str::slug('Tablets'), 'image' => 'categories/tablets.webp'],
            ['name' => 'Smartwatches', 'slug' => Str::slug('Smartwatches'), 'image' => 'categories/smartwatches.jpg'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'image' => $category['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
