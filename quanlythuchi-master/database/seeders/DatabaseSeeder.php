<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PersonsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(HouseholdsTableSeeder::class);
        $this->call(HouseholdMembersTableSeeder::class);
        $this->call(FeesTableSeeder::class);
        $this->call(TemporaryResidenceAndAbsenceTableSeeder::class);
    }
}
