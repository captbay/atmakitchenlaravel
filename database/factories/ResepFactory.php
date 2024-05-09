<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resep>
 */
class ResepFactory extends Factory
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
            'bahan_baku_id' => \App\Models\BahanBaku::inRandomOrder()->first()->id,
            'jumlah' => $this->faker->numberBetween(1, 100),
        ];
    }
}
