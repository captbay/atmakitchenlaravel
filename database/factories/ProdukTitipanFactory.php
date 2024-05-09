<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProdukTitipan>
 */
class ProdukTitipanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'penitip_id' => \App\Models\Penitip::inRandomOrder()->first()->id,
            'name' => $this->faker->text(),
            'harga' => $this->faker->numberBetween(10000, 100000),
            'kategori' => $this->faker->randomElement(['makanan', 'minuman']),
            'gambar' => $this->faker->imageUrl(),
        ];
    }
}
