<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function countRoles()
    {
        return User::selectRaw("COUNT(CASE WHEN role = 'owner' THEN 1 END) AS owners, COUNT(CASE WHEN role = 'seller' THEN 1 END) AS sellers")->first();
    }

    public function createUser(array $validated): void
    {
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'sellers_limit' => $validated['sellers_limit'],
            'company_name' => $validated['company_name'],
            'role' => $validated['role'],
            'status' => User::STATUS_ENABLED,
        ]);
    }

    public function getAdministrativeUsers()
    {
        return User::query()
            ->whereNotIn('role', ['seller'])
            ->withCount('sellers')
            ->get();
    }
}
