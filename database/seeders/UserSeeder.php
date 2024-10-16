<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Create admin user
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@mail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);

            // Create manager user
            User::create([
                'name' => 'Manager User',
                'email' => 'manager@mail.com',
                'password' => bcrypt('manager'),
                'role' => 'manager',
            ]);

            // Create regular user
            User::create([
                'name' => 'Regular User',
                'email' => 'user@mail.com',
                'password' => bcrypt('user'),
                'role' => 'user',
            ]);
    }
}
