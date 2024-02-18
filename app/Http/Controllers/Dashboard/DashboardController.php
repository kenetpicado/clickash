<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class DashboardController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }
    public function __invoke()
    {
        return inertia('Dashboard/Index', [
            'users' => $this->userService->countRoles(),
        ]);
    }
}
