<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return UserResource::make(auth()->user());
    }

    public function update(ProfileRequest $request)
    {
        User::where('id', auth()->id())->update($request->validated());

        return response()->noContent();
    }
}
