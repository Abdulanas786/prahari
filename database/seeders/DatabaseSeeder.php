<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only seed if tables are empty (prevents duplicates on re-deploy)
        if (Category::count() === 0) {
            $this->call([
                CategorySeeder::class,
                PrahariSeeder::class,
                CasesSeeder::class,
                ChallanSeeder::class,
                PaymentSeeder::class,
            ]);
        }
    }
}
