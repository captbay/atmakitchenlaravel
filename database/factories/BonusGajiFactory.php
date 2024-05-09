<?php

namespace Database\Factories;

use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BonusGaji>
 */
class BonusGajiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jabatan_id' => Jabatan::inRandomOrder()->first()->id,
            'gaji' => fake()->numberBetween(1000000, 10000000),
            'bonus' => fake()->numberBetween(1000000, 10000000),
        ];
    }
}
