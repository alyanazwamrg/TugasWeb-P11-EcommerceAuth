<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
            'name' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(3),
            'description' => fake()->paragraphs(2, true),
            'price' => fake()->numberBetween(15, 3000) * 1000,
            'stock' => fake()->numberBetween(0, 200),
            'published' => fake()->boolean(90),
        ];
    }
}