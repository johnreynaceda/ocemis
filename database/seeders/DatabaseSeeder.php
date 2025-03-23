<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       User::create([
        'name' => 'Administrator',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('password'),
        'role_id' => 1,
       ]);

       User::create([
        'name' => 'Coordinator',
        'email' => 'coordinator@gmail.com',
        'password' => bcrypt('password'),
        'role_id' => 2,
       ]);

       User::create([
        'name' => 'client',
        'email' => 'client@gmail.com',
        'password' => bcrypt('password'),
        'role_id' => 3,
       ]);

       Event::create([
        'name' => 'Wedding Ceremony',
        'amount' => 5000,
    ]);
       Event::create([
        'name' => 'Baptismal Services',
        'amount' => 3000,
    ]);
       Event::create([
        'name' => 'Youth Fellowship',
        'amount' => 0,
    ]);
    }

   

}
