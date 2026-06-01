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
            'Prahari' => $this->faker->name(),
            'Mobile' => $this->faker->numerify('9#########'),
            'AadhaarStatus' => $this->faker->randomElement(['Verified', 'Pending', 'Rejected']),
            'Bank_account_detail' => strtoupper($this->faker->bothify('BANK#######')),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
