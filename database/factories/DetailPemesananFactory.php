<?php

namespace Database\Factories;

use App\Models\Hampers;
use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\ProdukTitipan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailPemesanan>
 */
class DetailPemesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pemesanan_id' => Pemesanan::inRandomOrder()->first()->id,
            'produk_id' => Produk::inRandomOrder()->first()->id,
            'hampers_id' => Hampers::inRandomOrder()->first()->id,
            'produk_titipan_id' => ProdukTitipan::inRandomOrder()->first()->id,
            'jumlah' => fake()->numberBetween(0.5, 1),
            'total_harga' => fake()->numberBetween(1000000, 10000000),
            'is_sisaan' => fake()->numberBetween(0, 1),
        ];
    }
}
