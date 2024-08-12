<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple', 'slug' => Str::slug('Apple'), 'image' => 'brands/apple.png'],
            ['name' => 'Asus', 'slug' => Str::slug('Asus'), 'image' => 'brands/asus.webp'],
            ['name' => 'Samsung', 'slug' => Str::slug('Samsung'), 'image' => 'brands/samsung.png'],
            // ['name' => 'Xiaomi', 'slug' => Str::slug('Xiaomi'), 'image' => 'brands/xiaomi.png'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'name' => $brand['name'],
                'slug' => $brand['slug'],
                'image' => $brand['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
