<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "name" => "John Doe",
                "email" => "johndoe@gmail.com",
                "password" => Hash::make("password")
            ],
            [
                "name" => "Vendedor",
                "email" => "vendedor@gmail.com",
                "password" => Hash::make("password"),
                "user_id" => 1
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
