<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;

class PersonsTableSeeder extends Seeder
{
    public function run()
    {
        Person::factory()
            ->count(10)
            ->create();
    }
}
