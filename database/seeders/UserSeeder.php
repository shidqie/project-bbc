<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Kasir',
                'email' => 'kasir@warungbbc.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'kasir',
            ],
            [
                'name' => 'Pelayan',
                'email' => 'pelayan@warungbbc.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'pelayan',
            ],
            [
                'name' => 'Tim Dapur',
                'email' => 'dapur@warungbbc.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'dapur',
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@warungbbc.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'manager',
            ],
            [
                'name' => 'Pemilik',
                'email' => 'pemilik@warungbbc.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'pemilik',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
