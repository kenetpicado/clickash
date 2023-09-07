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
                "role" => RoleEnum::ROOT->value
            ],
            [
                "name" => "Kenet Picado",
                "email" => "kenetpicado1@gmail.com",
                "password" => Hash::make("26051998"),
                "role" => RoleEnum::ROOT->value
            ],
            [
                "name" => "Jairo Paniagua",
                "email" => "jeypaniagua@gmail.com",
                "password" => Hash::make("jey131322"),
                "role" => RoleEnum::ROOT->value
            ],
            [
                "name" => "John Doe",
                "email" => "johndoe@gmail.com",
                "password" => Hash::make("password"),
                "role" => RoleEnum::OWNER->value,
                'sellers_limit' => 10,
            ],
        ];

        foreach ($users as $user) {
            $created = User::create($user + ['status' => UserStatusEnum::ENABLED]);

            if ($created->role == RoleEnum::OWNER->value) {
                foreach (range(1, 10) as $index) {
                    User::create([
                        "name" => "Vendedor " . $index,
                        "email" => "vendedor{$index}@gmail.com",
                        "password" => Hash::make("password"),
                        "user_id" => $created->id,
                        "role" => RoleEnum::SELLER->value,
                        'status' => UserStatusEnum::ENABLED
                    ]);
                }
            }
        }
    }
}
