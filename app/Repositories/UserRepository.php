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
        $ownerId = auth()->user()->getOwnerId();

        return DB::table('users')
            ->Where('user_id', $ownerId)
            ->pluck('id')
            ->toArray();
    }

    public function hasReachedSellerLimit(): bool
    {
        return auth()->user()->sellers()->count() >= auth()->user()->sellers_limit;
    }

    public function toggleStatus($user)
    {
        $user->update([
            'status' => $user->status === 'enabled' ? 'disabled' : 'enabled',
        ]);
    }

    public function registerFreeAccount(array $request)
    {
        return User::create([
            'name' => $request['name'],
            'company_name' => $request['company_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => 'owner',
            'sellers_limit' => 0,
            'status' => 'enabled',
        ]);
    }
}
