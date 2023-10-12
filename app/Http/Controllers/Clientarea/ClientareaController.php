<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;

class ClientareaController extends Controller
{
    public function __invoke()
    {
        return inertia('Clientarea/Index');
    }
}
