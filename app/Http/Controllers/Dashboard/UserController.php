<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;
use App\Services\RaffleService;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly RaffleService $raffleService,
    ) {
    }

    public function index()
    {
        return inertia('Dashboard/User/Index', [
            'users' => $this->userService->getAdministrativeUsers(),
        ]);
    }

    public function show(User $user)
    {
        return inertia('Dashboard/User/Show', [
            'user' => $user->load('raffles'),
            'raffles' => $this->raffleService->getUnassignedRaffles($user->id),
        ]);
    }

    public function store(UserRequest $request)
    {
        $this->userService->createUser($request->validated());

        return back();
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
