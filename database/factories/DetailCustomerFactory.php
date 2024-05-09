<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailCustomer>
 */
class DetailCustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', '==', 'customer')->inRandomOrder()->first()->id,
            'total_poin' => fake()->numberBetween(0, 100),
            'saldo' => fake()->numberBetween(1000000, 100000000),
        ];
    }
}
