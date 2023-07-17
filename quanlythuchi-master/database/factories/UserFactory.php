<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition()
    {
        $person = \App\Models\Person::inRandomOrder()->first();
    
        return [
            'name' => $person->name,
            'email' => $person->email,
            'email_verified_at' => now(),
            'password' => Hash::make('1111'), // Replace 'password' with your desired default password
            'personId' => $person->id,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'remember_token' => null,
        ];
    }    
}
