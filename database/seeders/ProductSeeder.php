<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua ID kategori yang ada
        $categories = Category::pluck('id');

        if ($categories->isEmpty()) {
            $this->command->info('No categories found, please run CategorySeeder first.');
            return;
        }

        // Ambil semua ID brand yang ada
        $brands = Brand::pluck('id');
        if ($brands->isEmpty()) {
            $this->command->info('No brands found, please run BrandSeeder first.');
            return;
        }
        $products = [
            [
                'name' => 'Classic Denim Jacket',
                'description' => 'A timeless denim jacket for all seasons.',
                'regular_price' => 79.99,
                'SKU' => 'SKU001',
                'quantity' => 50,
                'image' => 'p1.jpg',
                'images' => 'p1_g1.jpg,p1_g2.jpg,p1_g3.jpg',
                'category_id' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Kemeja super Borax',
                'description' => 'Light and breezy dress perfect for summer.',
                'regular_price' => 49.99,
                'sale_price' => 39.99,
                'SKU' => 'SKU002',
                'quantity' => 100,
                'image' => 'p2.jpg',
                'images' => 'p2_g1.jpg,p2_g2.jpg,p2_g3.jpg',
                'category_id' => 2,
                'brand_id' => 2,
            ],
            [
                'name' => 'Sweater Yellow light',
                'description' => 'High-quality cotton with a comfortable fit.',
                'regular_price' => 89.99,
                'SKU' => 'SKU003',
                'quantity' => 75,
                'image' => 'p1.jpg',
                'images' => 'p1_g1.jpg,p1_g2.jpg,p1_g3.jpg',
                'category_id' => 3,
                'brand_id' => 3,
            ],
            [
                'name' => 'Kaos Polos Putih',
                'description' => 'A classic white t-shirt for everyday wear.',
                'regular_price' => 19.99,
                'SKU' => 'SKU004',
                'quantity' => 200,
                'image' => 'p2.jpg',
                'images' => 'p2_g1.jpg,p2_g2.jpg,p2_g3.jpg',
                'category_id' => 4,
                'brand_id' => 4,
            ],
            [
                'name' => 'Celana Jeans Slim Fit',
                'description' => 'Stylish slim fit jeans for a modern look.',
                'regular_price' => 59.99,
                'SKU' => 'SKU005',
                'quantity' => 80,
                'image' => 'p1.jpg',
                'images' => 'p1_g1.jpg,p1_g2.jpg,p1_g3.jpg',
                'category_id' => 5,
                'brand_id' => 5,
            ],
            [
                'name' => 'Sepatu Sneakers Casual',
                'description' => 'Comfortable sneakers for daily use.',
                'regular_price' => 69.99,
                'SKU' => 'SKU006',
                'quantity' => 120,
                'image' => 'p2.jpg',
                'images' => 'p2_g1.jpg,p2_g2.jpg,p2_g3.jpg',
                'category_id' => 6,
                'brand_id' => 6,
            ],
            [
                'name' => 'Tas Ransel Stylish',
                'description' => 'A stylish backpack for everyday use.',
                'regular_price' => 39.99,
                'SKU' => 'SKU007',
                'quantity' => 60,
                'image' => 'p1.jpg',
                'images' => 'p1_g1.jpg,p1_g2.jpg,p1_g3.jpg',
                'category_id' => 7,
                'brand_id' => 7,
            ],
            [
                'name' => 'Aksesoris Fashionable',
                'description' => 'Trendy accessories to complete your look.',
                'regular_price' => 29.99,
                'SKU' => 'SKU008',
                'quantity' => 150,
                'image' => 'p2.jpg',
                'images' => 'p2_g1.jpg,p2_g2.jpg,p2_g3.jpg',
                'category_id' => 8,
                'brand_id' => 8,
            ],
            [
                'name' => 'Dress Elegan',
                'description' => 'Elegant dress for special occasions.',
                'regular_price' => 89.99,
                'SKU' => 'SKU009',
                'quantity' => 40,
                'image' => 'p1.jpg',
                'images' => 'p1_g1.jpg,p1_g2.jpg,p1_g3.jpg',
                'category_id' => 9,
                'brand_id' => 9,
            ],
            [
                'name' => 'Outerwear Trendy',
                'description' => 'Trendy outerwear for the fashion-forward.',
                'regular_price' => 99.99,
                'SKU' => 'SKU010',
                'quantity' => 30,
                'image' => 'p2.jpg',
                'images' => 'p2_g1.jpg,p2_g2.jpg,p2_g3.jpg',
                'category_id' => 10,
                'brand_id' => 10,
            ],
        ];


        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'regular_price' => $productData['regular_price'],
                'sale_price' => $productData['sale_price'] ?? null,
                'SKU' => $productData['SKU'],
                'stock_status' => 'instock',
                'quantity' => $productData['quantity'],
                'image' => $productData['image'],
                'images' => $productData['images'],
                'category_id' => $productData['category_id'],
                'brand_id' => $productData['brand_id'],
            ]);
        }
    }
}
