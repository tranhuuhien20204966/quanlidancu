<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HouseholdMember;

class HouseholdMembersTableSeeder extends Seeder
{
    public function run()
    {
        HouseholdMember::factory()
            ->count(10)
            ->create();
    }
}
