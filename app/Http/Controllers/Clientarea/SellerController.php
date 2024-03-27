<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\User;

class SellerController extends Controller
{
    public function index()
    {
        return inertia('Clientarea/Seller/Index');
    }

    public function show(User $seller)
    {
        return inertia('Clientarea/Seller/Show', ['seller' => $seller]);
    }
}
