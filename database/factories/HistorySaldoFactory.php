<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistorySaldo>
 */
class HistorySaldoFactory extends Factory
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
            'total_saldo' => fake()->numberBetween(1000000, 10000000),
        ];
    }
}
