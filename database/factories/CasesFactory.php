<?php

namespace Database\Factories;

use App\Models\Cases;
use App\Models\Prahari;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cases>
 */
class CasesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prahari_id' => Prahari::inRandomOrder()->first()->id ?? Prahari::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'Location' => $this->faker->randomElement([
                'Lucknow',
                'Gomti Nagar',
                'Indira Nagar',
                'Aliganj',
                'Hazratganj',
                'Aminabad',
                'Gokhale Marg',
                'Ashiyana',
                'Alambagh',
                'Sitapur',
            ]),
            'evidence_file' => 'evidence/' .$this->faker->uuid() . '.jpg',
            'status' => $this->faker->randomElement(['Open', 'In Progress', 'Closed']),
            'violation_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
