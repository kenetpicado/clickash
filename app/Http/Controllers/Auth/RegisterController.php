<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;

class RegisterController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function create()
    {
        return inertia('Auth/Register');
    }

    public function store(RegisterRequest $request)
    {
        $user = $this->userRepository->registerFreeAccount($request->validated());

        auth()->login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
