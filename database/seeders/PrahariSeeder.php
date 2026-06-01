<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prahari;

class PrahariSeeder extends Seeder
{
    public function run(): void
    {
        Prahari::factory(25)->create();
    }
}