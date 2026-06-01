<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Prahari;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        $prahari = Prahari::inRandomOrder()->first() ?? Prahari::factory()->create();

        return [
            'prahari_id' => $prahari->id,
            'bank_account' => $prahari->Bank_account_detail . '-' . Str::upper(Str::random(4)),
            'amount' => $this->faker->randomFloat(2, 1000, 20000),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected']),
            'date' => Carbon::instance($this->faker->dateTimeBetween('-1 year', 'now')),
        ];
    }
}
