<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create an admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@temp-example.com',
            'password' => Hash::make('asdqwe123'),
            'is_admin' => true,
        ]);

        // Create 5 simple users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@temp-example.com',
                'password' => Hash::make('asdqwe321'),
                'is_admin' => false,
            ]);
        }

        $this->command->info('Users created successfully!');
        $this->command->info('Admin: admin@temp-example.com / asdqwe123');
        $this->command->info('Users: user1@temp-example.com - user5@temp-example.com / asdqwe321');
    }
}
