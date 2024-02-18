<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;

class ToggleStatusController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function __invoke(User $seller)
    {
        $this->userService->toggleStatus($seller);

        return back();
    }
}
