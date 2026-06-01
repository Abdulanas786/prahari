<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Challan;

class ChallanSeeder extends Seeder
{
    public function run(): void
    {
       Challan::factory(25)->create();
    }
}