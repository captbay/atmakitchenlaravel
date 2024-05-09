<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(),
            'kategori' => $this->faker->randomElement(['makanan', 'minuman']),
            'kuota_harian' => $this->faker->numberBetween(1, 10),
            'harga' => $this->faker->numberBetween(10000, 100000),
            'gambar' => $this->faker->imageUrl(),
        ];
    }
}
