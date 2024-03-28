<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return inertia('Clientarea/Profile/Index');
    }
}
