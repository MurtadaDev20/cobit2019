<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Murtada Luqman',
            'email' => 'murtada@gmail.com',
            'password' => bcrypt('12345678'),
        ])->roles()->attach(1); // Attach Admin role to the user

    }
}
