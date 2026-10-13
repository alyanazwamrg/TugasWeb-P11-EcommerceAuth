<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catalogue = [
            'Elektronik' => ['Smartphone Samsung Galaxy A55', 'Laptop ASUS Vivobook 14', 'Earbuds Xiaomi Redmi Buds 5', 'Smartwatch Amazfit Bip 5', 'Power Bank Anker 20000mAh', 'Keyboard Wireless Logitech K380', 'Mouse Wireless Logitech M331', 'Speaker Bluetooth JBL Go 3', 'Monitor LG 24 Inch IPS'],
            'Fashion' => ['Kemeja Flannel Pria', 'Kaos Polos Cotton Combed 30s', 'Celana Chino Slim Fit', 'Jaket Hoodie Fleece', 'Sepatu Sneakers Canvas', 'Tas Ransel Laptop Waterproof', 'Dress Batik Modern Wanita', 'Hijab Pashmina Ceruty', 'Jam Tangan Analog Kulit'],
            'Rumah Tangga' => ['Rice Cooker Miyako 1.8L', 'Blender Philips 2L', 'Set Panci Stainless 5 Pcs', 'Dispenser Air Panas Dingin', 'Setrika Uap Philips', 'Kipas Angin Berdiri Cosmos', 'Lampu LED Philips 14W', 'Sapu Pel Lantai Spin Mop', 'Rak Sepatu Susun 4 Tingkat'],
            'Olahraga' => ['Matras Yoga TPE 6mm', 'Dumbbell Vinyl 5 Kg', 'Raket Badminton Yonex Astrox', 'Bola Sepak Adidas Size 5', 'Sepatu Lari Ortuseight', 'Botol Minum Tumbler 1 Liter', 'Resistance Band Set', 'Skipping Rope Speed', 'Sarung Tangan Gym'],
            'Buku & Alat Tulis' => ['Novel Laskar Pelangi', 'Buku Atomic Habits', 'Buku Filosofi Teras', 'Pulpen Gel Pilot G2', 'Buku Tulis Sidu 58 Lembar', 'Stabilo Boss Highlighter Set', 'Binder A5 Notebook Refill', 'Kalkulator Casio fx-991EX', 'Papan Tulis Mini Magnetik'],
            'Kecantikan' => ['Sunscreen Wardah SPF 30', 'Facial Wash Cetaphil', 'Serum Niacinamide Somethinc', 'Lip Tint Maybelline', 'Sampo Pantene Anti Ketombe', 'Body Lotion Vaseline', 'Masker Wajah Sheet Innisfree', 'Pelembab Skintific 5X Ceramide', 'Sabun Cuci Muka Biore'],
        ];

        $userIds = User::pluck('id');
        $tagIds = Tag::pluck('id');
        $adminId = User::where('role', 'admin')->value('id');

        foreach ($catalogue as $categoryName => $names) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($names as $name) {
                $product = Product::factory()->create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'category_id' => $category->id,
                    'user_id' => $userIds->random(),
                ]);

                // tiap produk dapat 1-3 tag acak (tabel pivot)
                $product->tags()->attach(
                    $tagIds->random(rand(1, 3))->all(),
                    ['created_by' => $adminId]
                );
            }
        }
    }
}