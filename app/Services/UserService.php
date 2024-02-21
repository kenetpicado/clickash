<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

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

    public function registerFreeAccount(array $validated)
    {
        return $this->userRepository->registerFreeAccount($validated);
    }

    public function getAdministrativeUsers()
    {
        return User::query()
            ->whereNotIn('role', ['seller'])
            ->withCount('sellers')
            ->get();
    }

    public function getSellers()
    {
        return $this->userRepository->getSellers();
    }

    public function createSeller(array $request)
    {
        if ($this->userRepository->hasReachedSellerLimit()) {
            throw new \Exception('Ha alcanzado el límite de vendedores permitidos', 403);
        }

        $this->userRepository->createSeller($request);
    }

    public function toggleStatus($seller)
    {
        $this->userRepository->toggleStatus($seller);
    }

    public function updateProfile(array $validated)
    {
        if (auth()->user()->isSeller()) {
            $validated['company_name'] = $this->userRepository->getCompanyName(auth()->user()->user_id);
        }

        auth()->user()->updateProfile($validated);

        if (auth()->user()->isOwner()) {
            $this->userRepository->updateCompanyNameInSellers($validated['company_name']);
        }
    }
}
