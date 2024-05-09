<?php

namespace Database\Factories;

use App\Models\Hampers;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailHampers>
 */
class DetailHampersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hampers_id' => Hampers::inRandomOrder()->first()->id,
            'produk_id' => Produk::inRandomOrder()->first()->id,
            // random float between 0.5 and until 1
            'jumlah' => fake()->numberBetween(0.5, 1),
        ];
    }
}
