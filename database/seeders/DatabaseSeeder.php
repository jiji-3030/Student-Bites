<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create one admin user
    User::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // Create 10 student users
    User::factory()->count(10)->create([
        'role' => 'student',
    ]);

    $this->call(PostSeeder::class);
    }


}
