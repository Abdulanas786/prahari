<?php

namespace Database\Factories;

use App\Models\Challan;
use App\Models\Cases;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends Factory<Challan>
 */
class ChallanFactory extends Factory
{
    protected $model = Challan::class;

    public function definition(): array
    {
        $case = Cases::inRandomOrder()->first() ?? Cases::factory()->create();

        return [
            'prahari_id' => $case->prahari_id,
            'case_id' => $case->id,
            'category_id' => $case->category_id,
            'status' => $this->faker->randomElement(['Paid', 'Pending', 'Cancelled']),
            'Date' => Carbon::instance($this->faker->dateTimeBetween('-1 year', 'now')),
        ];
    }
}
