<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenggunaanStockProdukSisa>
 */
class PenggunaanStockProdukSisaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'produk_id' => \App\Models\Produk::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['masuk', 'keluar']),
            'kouta_terpakai' => $this->faker->numberBetween(1, 10),
        ];
    }
}
