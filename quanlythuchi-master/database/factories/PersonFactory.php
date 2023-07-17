<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Faker\Provider\vi_VN\Person as ViPersonProvider;
use Faker\Provider\vi_VN\Address as ViAddressProvider;
use Faker\Provider\vi_VN\PhoneNumber as ViPhoneNumberProvider;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        $faker = \Faker\Factory::create('vi_VN');
        $faker->addProvider(new ViPersonProvider($faker));
        $faker->addProvider(new ViAddressProvider($faker));
        $faker->addProvider(new ViPhoneNumberProvider($faker));

        $avatarNumber = $faker->numberBetween(1, 100);

        return [
            'idCard' => $faker->numerify('#########'),
            'firstName' => $faker->firstName($faker->randomElement(['male', 'female'])),
            'lastName' => $faker->lastName,
            'dateOfBirth' => $faker->date(),
            'avatar' => 'uploads/avatar/' . $avatarNumber . '.jpeg',
            'gender' => $faker->randomElement(['male', 'female']),
            'email' => $faker->email,
            'numberPhone' => $faker->phoneNumber,
            'ethnic' => $faker->word,
            'nationality' => 'Việt Nam',
            'address' => $faker->address,
            'occupation' => $faker->jobTitle,
            'educationLevel' => $faker->randomElement([null, 'Cấp 3', 'Cử nhân', 'Thạc sĩ', 'PhD']),
            'maritalStatus' => $faker->randomElement(['single', 'married']),
            'status' => 'alive',
        ];
    }
}
