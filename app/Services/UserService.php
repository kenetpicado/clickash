<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
use App\Models\Transaction;
use App\Models\User;
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

    public function registerFreeAccount(array $request)
    {
        return User::create([
            'name' => $request['name'],
            'company_name' => $request['company_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => RoleEnum::OWNER->value,
            'sellers_limit' => 2,
            'status' => UserStatusEnum::ENABLED,
        ]);
    }

    public function getTeam()
    {
        return User::where('id', auth()->id())
            ->orWhere('user_id', auth()->id())
            ->pluck('id')
            ->toArray();
    }
}
