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
                'name' => 'Kenet Picado',
                'email' => 'kenetpicado1@gmail.com',
                'password' => Hash::make('26051998'),
                'role' => RoleEnum::ROOT->value,
            ],
            [
                'name' => 'Jairo Paniagua',
                'email' => 'jeypaniagua@gmail.com',
                'password' => Hash::make('jey131322'),
                'role' => RoleEnum::ROOT->value,
            ],
            [
                'name' => 'Demo',
                'email' => 'demo@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => RoleEnum::OWNER->value,
            ],
        ];

        foreach ($users as $user) {
            $created = User::create($user + ['status' => UserStatusEnum::ENABLED]);

            if ($created->role === RoleEnum::OWNER->value) {
                foreach (range(1, 3) as $index) {
                    User::create([
                        'name' => 'Vendedor '.$index,
                        'email' => "vendedor{$index}@gmail.com",
                        'password' => Hash::make('password'),
                        'user_id' => $created->id,
                        'role' => RoleEnum::SELLER->value,
                        'status' => UserStatusEnum::ENABLED,
                        'company_name' => 'JM',
                    ]);
                }
            }
        }
    }
}
