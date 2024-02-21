<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ProfileRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function index()
    {
        return UserResource::make(auth()->user());
    }

    public function update(ProfileRequest $request)
    {
        $this->userService->updateProfile($request->validated());

        return self::index();
    }
}
