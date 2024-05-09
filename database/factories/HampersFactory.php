<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hampers>
 */
class HampersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(),
            'harga' => fake()->numberBetween(1000000, 10000000),
            'kategori' => fake()->randomElement(['makanan', 'minuman']),
            'gambar' => fake()->imageUrl(),
        ];
    }
}
