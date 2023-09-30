<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return UserResource::make(auth()->user());
    }

    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->validated());

        return self::index();
    }
}
