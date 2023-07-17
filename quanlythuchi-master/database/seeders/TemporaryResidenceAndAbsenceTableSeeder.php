<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemporaryResidenceAndAbsence;

class TemporaryResidenceAndAbsenceTableSeeder extends Seeder
{
    public function run()
    {
        TemporaryResidenceAndAbsence::factory()
            ->count(10)
            ->create();
    }
}
