<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoryPoin>
 */
class HistoryPoinFactory extends Factory
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
            'jenis_history' => fake()->randomElement(['poin', 'bonus']),
            'total_poin' => fake()->numberBetween(1000000, 10000000),
        ];
    }
}
