<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Call all seeders in proper order
        $this->call([
            CategorySeeder::class,
            PrahariSeeder::class,
            CasesSeeder::class,
            ChallanSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
