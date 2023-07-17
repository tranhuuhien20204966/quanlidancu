<?php

namespace Database\Factories;

use DateTime;
use App\Models\Fee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Faker\Provider\vi_VN\Person as ViPersonProvider;
use Faker\Provider\vi_VN\Address as ViAddressProvider;
use Faker\Provider\vi_VN\PhoneNumber as ViPhoneNumberProvider;

class FeeFactory extends Factory
{
    protected $model = Fee::class;

    public function definition()
    {
        $faker = \Faker\Factory::create('vi_VN');
        $faker->addProvider(new ViPersonProvider($faker));
        $faker->addProvider(new ViAddressProvider($faker));
        $faker->addProvider(new ViPhoneNumberProvider($faker));

        $createdAt = $faker->dateTimeBetween('2023-01-01', 'now');
        $startDate = $faker->dateTimeBetween($createdAt, '2023-12-31')->format('Y-m-d');

        return [
            'name' => $faker->word,
            'amount' => $faker->randomElement(['mandatory' => $faker->numberBetween(1000, 10000), 'voluntary' => null]),
            'type' => $faker->randomElement(['mandatory', 'voluntary']),
            'startDate' => $startDate,
            'endDate' => $faker->dateTimeBetween($startDate, '2023-12-31')->format('Y-m-d'),
            'created_at' => $createdAt,
            'updated_at' => $faker->dateTimeBetween($createdAt, 'now'),
        ];
    }
}
