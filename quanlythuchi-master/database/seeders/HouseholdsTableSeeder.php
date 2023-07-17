<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Household;

class HouseholdsTableSeeder extends Seeder
{
    public function run()
    {
        Household::factory()
            ->count(10)
            ->create();
    }
}
