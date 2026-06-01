<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'Type' => $this->faker->randomElement([
                'Traffic Violation',
                'Parking Violation',
                'Speed Limit Violation',
                'No License',
                'Wrong Parking',
                'Signal Jump',
                'Overloading',
                'No Helmet',
                'Mobile Phone Usage',
                'Driving Without Seatbelt',
            ]),
            'Amount' => (string) $this->faker->numberBetween(100, 2000),
        ];
    }
}
