<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUserId(): int
    {
        return self::isOwner()
            ? auth()->id()
            : auth()->user()->user_id;
    }

    public function getTeamIds($user_id): array
    {
        return User::query()
            ->where('id', $user_id)
            ->orWhere('user_id', $user_id)
            ->pluck('id')
            ->toArray();
    }

    public function isOwner(): bool
    {
        return auth()->user()->role == RoleEnum::OWNER->value;
    }

    public function createSeller(array $request)
    {
        if (auth()->user()->sellers()->count() >= auth()->user()->sellers_limit)
            abort(403, "Ha alcanzado el límite de vendedores permitidos");

        auth()->user()
            ->sellers()
            ->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'status' => UserStatusEnum::ENABLED->value,
                'password' => Hash::make($request['password']),
                'role' => RoleEnum::SELLER->value,
                'company_name' => auth()->user()->company_name,
            ]);
    }

    public function registerFreeAccount(array $request)
    {
        return User::create([
            'name' => $request['name'],
            'company_name' => $request['company_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => RoleEnum::OWNER->value,
            'sellers_limit' => 2,
            'status' => UserStatusEnum::ENABLED
        ]);
    }
}
