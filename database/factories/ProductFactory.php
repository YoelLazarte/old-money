<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => fake()->sentence(),
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(10000, 50000),
            'size' => fake()->randomElement(['S', 'M', 'L', 'XL']),
            'img' => fake()->imageUrl(640, 480, 'product', true),
        ];
    }
}