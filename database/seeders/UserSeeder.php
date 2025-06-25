<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'me',
                'email' => 'me@mail.com',
                'password' => Hash::make('password'),
                'phone' => '+60123456789',
                'role' => 'admin',
            ],
            [
                'name' => 'you',
                'email' => 'you@mail.com',
                'password' => Hash::make('password'),
                'phone' => '+60123456789',
                'role' => 'user',
            ],
            [
                'name' => 'us',
                'email' => 'us@mail.com',
                'phone' => '+60123456789',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        ]);
    }
}
