<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoryPengembalianSaldo>
 */
class HistoryPengembalianSaldoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::where('role',  'customer')->inRandomOrder()->first()->id,
            'nama_bank' => fake()->text(),
            'nomor_rekening' => fake()->numberBetween(1000000, 10000000),
            'nama_pemilik' => fake()->name(),
            'jumlah_pengembalian' => fake()->numberBetween(1000000, 10000000),
            'status' => fake()->randomElement(['pending', 'success', 'failed']),
        ];
    }
}
