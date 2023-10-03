<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class ToggleStatusController extends Controller
{
    public function __invoke(User $seller)
    {
        (new UserService)->toggleStatus($seller);

        return back();
    }
}
