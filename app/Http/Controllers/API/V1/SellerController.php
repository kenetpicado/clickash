<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        return SellerResource::collection(auth()->user()->sellers);
    }
}
