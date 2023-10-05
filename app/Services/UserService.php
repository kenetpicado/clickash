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

    public function createSeller(array $request)
    {
        if (auth()->user()->sellers()->count() >= auth()->user()->sellers_limit) {
            abort(403, 'Ha alcanzado el límite de vendedores permitidos');
        }

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
            'status' => UserStatusEnum::ENABLED,
        ]);
    }

    public function getTransactions(int $user_id, array $request)
    {
        $start_date = $request['start_date'].' 00:00:00';
        $end_date = $request['end_date'].' 23:59:00';

        return Transaction::query()
            ->where('user_id', $user_id)
            ->whereBetween('created_at', [$start_date,  $end_date])
            ->with('raffle:id,name')
            ->orderBy('id', $request['order'] ?? 'desc')
            ->paginate();
    }

    public function toggleStatus($user)
    {
        $user->update([
            'status' => $user->status === UserStatusEnum::ENABLED->value ? UserStatusEnum::DISABLED->value : UserStatusEnum::ENABLED->value,
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
