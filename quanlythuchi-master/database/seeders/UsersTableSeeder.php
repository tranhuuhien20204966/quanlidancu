<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('1111'), // You may change this password according to your requirements
            // 'role' => 'admin',
        ]);

        User::factory()
            ->count(2)
            ->create();
    }
}
