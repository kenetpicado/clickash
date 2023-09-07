<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        //
        return UserStatusEnum::cases();
    }
}
