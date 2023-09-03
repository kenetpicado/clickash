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
                "name" => "Kenet Picado",
                "email" => "kenetpicado1@gmail.com",
                "password" => Hash::make("26051998")
            ],
            [
                "name" => "Jairo Paniagua",
                "email" => "jeypaniagua@gmail.com",
                "password" => Hash::make("jey131322")
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
