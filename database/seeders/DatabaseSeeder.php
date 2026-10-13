<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun tetap untuk testing 3 role (password semuanya: "password")
        User::factory()->admin()->create(['name' => 'Admin Toko', 'email' => 'admin@example.com']);
        User::factory()->editor()->create(['name' => 'Editor Toko', 'email' => 'editor@example.com']);
        User::factory()->create(['name' => 'User Biasa', 'email' => 'user@example.com']);
        User::factory()->count(7)->create();

        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            ProductSeeder::class,
        ]);

        // Pesanan + item untuk semua user ber-role "user"
        $products = Product::all();

        User::where('role', 'user')->get()->each(function ($user) use ($products) {
            Order::factory()->count(rand(1, 3))->create(['user_id' => $user->id])
                ->each(function ($order) use ($products) {
                    $products->random(rand(1, 4))->each(function ($p) use ($order) {
                        $order->items()->create([
                            'product_id' => $p->id,
                            'qty' => rand(1, 3),
                            'price' => $p->price,
                        ]);
                    });
                });
        });
    }
}