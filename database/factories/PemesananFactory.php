<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemesanan>
 */
class PemesananFactory extends Factory
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
            'kurir_id' => \App\Models\Karyawan::inRandomOrder()->first()->id,
            'status' => fake()->randomElement(['pending', 'success', 'failed']),
            'bukti_pembayaran' => fake()->imageUrl(),
            'no_pemesanan' => fake()->numberBetween(1000000, 10000000),
            'jarak' => fake()->numberBetween(0, 100),
            'subtotal_awal' => fake()->numberBetween(1000000, 10000000),
            'ongkos_kirim' => fake()->numberBetween(1000000, 10000000),
            'potongan_poin' => fake()->numberBetween(1000000, 10000000),
            'subtotal_akhir' => fake()->numberBetween(1000000, 10000000),
            'total_tip' => fake()->numberBetween(1000000, 10000000),
            'tanggal_pesan' => fake()->dateTime(),
            'tanggal_lunas' => fake()->dateTime(),
            'tanggal_ambil' => fake()->dateTime(),
            'total_poin' => fake()->numberBetween(1000000, 10000000),
        ];
    }
}
