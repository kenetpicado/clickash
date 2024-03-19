<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Services\UserService;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function index()
    {
        return inertia('Clientarea/Profile/Index', [
            'user' => auth()->user()->loadCount('sellers'),
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $this->userService->updateProfile($request->validated());

        return redirect()->route('clientarea.raffles.index');
    }
}
