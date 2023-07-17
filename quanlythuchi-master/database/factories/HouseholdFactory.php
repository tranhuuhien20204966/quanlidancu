<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Faker\Provider\vi_VN\Address as ViAddressProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Household;

class HouseholdFactory extends Factory
{
    protected $model = Household::class;

    public function definition()
    {
        $faker = \Faker\Factory::create('vi_VN');
        $faker->addProvider(new ViAddressProvider($faker));

        return [
            'address' => $faker->address,
        ];
    }
}
