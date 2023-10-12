<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function getSellers()
    {
        return User::where('user_id', auth()->id())->get(['id', 'name', 'email', 'last_login', 'status']);
    }

    public function createSeller(array $request)
    {
        User::create([
            'user_id' => auth()->id(),
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'company_name' => auth()->user()->company_name,
            'role' => 'seller',
            'status' => 'enabled',
        ]);
    }

    public function getTeam(): array
    {
        return DB::table('users')
            ->where('id', auth()->id())
            ->orWhere('user_id', auth()->id())
            ->pluck('id')
            ->toArray();
    }

    public function hasReachedSellerLimit(): bool
    {
        return auth()->user()->sellers()->count() >= auth()->user()->sellers_limit;
    }
}