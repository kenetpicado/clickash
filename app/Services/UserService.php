<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createSeller(array $request)
    {
        if (auth()->user()->sellers()->count() >= auth()->user()->sellers_limit)
            abort(403, 'You have reached the maximum number of sellers');

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'status' => $request['status'],
            'password' => Hash::make($request['password']),
            'role' => RoleEnum::SELLER,
        ]);
    }

    public function registerFreeAccount(array $request)
    {
        return User::create([
            'name' => $request['name'],
            'company_name' => $request['company_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => RoleEnum::OWNER,
            'sellers_limit' => 2,
            'status' => UserStatusEnum::ENABLED
        ]);
    }
}
