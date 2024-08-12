<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categoryIds = DB::table('categories')->pluck('id', 'name');
        $brandIds = DB::table('brands')->pluck('id', 'name');

        $products = [
            [
                'category_id' => $categoryIds['Laptops'] ?? null,
                'brand_id' => $brandIds['Apple'] ?? null,
                'name' => 'MacBook Air M1',
                'slug' => Str::slug('MacBook Air M1'),
                'images' => json_encode(['products/macbook_air_m1_1.png', 'products/macbook_air_m1_2.png']),
                'description' => 'Apple MacBook Air with M1 chip.',
                'stock' => 10,
                'price' => 14999999,
                'sku' => 'MBA-M1-2024',
                'is_active' => true,
            ],
            [
                'category_id' => $categoryIds['Smartphones'] ?? null,
                'brand_id' => $brandIds['Samsung'] ?? null,
                'name' => 'Galaxy S21',
                'slug' => Str::slug('Galaxy S21'),
                'images' => json_encode(['products/galaxy_s21_1.avif', 'products/galaxy_s21_2.avif', 'products/galaxy_s21_3.avif']),
                'description' => 'Samsung Galaxy S21 with latest features.',
                'stock' => 20,
                'price' => 11999999,
                'sku' => 'GS21-2024',
                'is_active' => true,
            ],
            [
                'category_id' => $categoryIds['Smartphones'] ?? null,
                'brand_id' => $brandIds['Apple'] ?? null,
                'name' => 'iPhone 13',
                'slug' => Str::slug('iPhone 13'),
                'images' => json_encode(['products/iphone_13_1.webp', 'products/iphone_13_2.webp', 'products/iphone_13_3.webp']),
                'description' => 'Apple iPhone 13 with A15 Bionic chip.',
                'stock' => 15,
                'price' => 13999999,
                'sku' => 'IP13-2024',
                'is_active' => true,
            ],
            [
                'category_id' => $categoryIds['Smartwatches'] ?? null,
                'brand_id' => $brandIds['Apple'] ?? null,
                'name' => 'Apple Watch Series 7',
                'slug' => Str::slug('Apple Watch Series 7'),
                'images' => json_encode(['apple_watch_series_7.jpg']),
                'images' => json_encode(['products/apple_watch_series_7_1.jpg', 'products/apple_watch_series_7_2.jpg']),
                'description' => 'Apple Watch Series 7 with new design.',
                'stock' => 25,
                'price' => 5999999,
                'sku' => 'AW7-2024',
                'is_active' => true,
            ],
            [
                'category_id' => $categoryIds['Laptops'] ?? null,
                'brand_id' => $brandIds['Asus'] ?? null,
                'name' => 'Asus ZenBook 14',
                'slug' => Str::slug('Asus ZenBook 14'),
                'images' => json_encode(['asus_zenbook_14.jpg']),
                'images' => json_encode(['products/asus_zenbook_14_1.png', 'products/asus_zenbook_14_2.png']),
                'description' => 'Asus ZenBook 14 with Intel Core i7 processor.',
                'stock' => 12,
                'price' => 17999999,
                'sku' => 'ZEN14-2024',
                'is_active' => true,
            ],
            [
                'category_id' => $categoryIds['Tablets'] ?? null,
                'brand_id' => $brandIds['Asus'] ?? null,
                'name' => 'Asus ZenPad 10',
                'slug' => Str::slug('Asus ZenPad 10'),
                'images' => json_encode(['products/asus_zenpad_10_1.png']),
                'description' => 'Asus ZenPad 10 with high-resolution display.',
                'stock' => 18,
                'price' => 4999999,
                'sku' => 'ZENPAD10-2024',
                'is_active' => true,
            ],
            // [
            //     'category_id' => $categoryIds['Smartphones'] ?? null,
            //     'brand_id' => $brandIds['Xiaomi'] ?? null,
            //     'name' => 'Xiaomi Mi 11',
            //     'slug' => Str::slug('Xiaomi Mi 11'),
            //     'images' => json_encode([]),
            //     'description' => 'Xiaomi Mi 11 with Snapdragon 888.',
            //     'stock' => 22,
            //     'price' => 8999999,
            //     'sku' => 'MI11-2024',
            //     'is_active' => true,
            // ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'category_id' => $product['category_id'],
                'brand_id' => $product['brand_id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'images' => $product['images'],
                'description' => $product['description'],
                'stock' => $product['stock'],
                'price' => $product['price'],
                'sku' => $product['sku'],
                'is_active' => $product['is_active'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
