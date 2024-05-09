<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengeluaranLainnya>
 */
class PengeluaranLainnyaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'owner')->inRandomOrder()->first()->id,
            'name' => fake()->text(),
            'total_harga' => fake()->numberBetween(1000000, 10000000),
            'waktu' => fake()->dateTime(),
        ];
    }
}
