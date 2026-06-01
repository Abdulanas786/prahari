<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cases;

class CasesSeeder extends Seeder
{
    public function run(): void
    {
        Cases::factory(25)->create();
    }
}