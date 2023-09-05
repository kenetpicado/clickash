<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
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
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make("password"),
                "role" => RoleEnum::ROOT
            ],
            [
                "name" => "Kenet Picado",
                "email" => "kenetpicado1@gmail.com",
                "password" => Hash::make("26051998"),
                "role" => RoleEnum::ROOT
            ],
            [
                "name" => "Jairo Paniagua",
                "email" => "jeypaniagua@gmail.com",
                "password" => Hash::make("jey131322"),
                "role" => RoleEnum::ROOT
            ],
            [
                "name" => "John Doe",
                "email" => "johndoe@gmail.com",
                "password" => Hash::make("password"),
                "role" => RoleEnum::OWNER
            ],
            [
                "name" => "Vendedor",
                "email" => "vendedor@gmail.com",
                "password" => Hash::make("password"),
                "user_id" => 4,
                "role" => RoleEnum::SELLER
            ]
        ];

        foreach ($users as $user) {
            User::create($user + ['status' => UserStatusEnum::ENABLED]);
        }
    }
}
