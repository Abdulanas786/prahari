<?php

namespace Database\Factories;

use App\Models\Prahari;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Prahari>
 */
class PrahariFactory extends Factory
{
    protected $model = Prahari::class;

    public function definition(): array
    {
        return [
            'Prahari' => fake()->name(),
            'Mobile' => fake()->numerify('9#########'),
            'AadhaarStatus' => fake()->randomElement(['Verified', 'Pending', 'Rejected']),
            'Bank_account_detail' => strtoupper(fake()->bothify('BANK#######')),
            'status' => fake()->randomElement(['Active', 'Inactive']),
        ];
    }
}
