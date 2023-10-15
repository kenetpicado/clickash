<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return inertia('Profile');
    }

    public function update(ProfileRequest $request)
    {
        $user = User::find(auth()->id());

        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->company_name
        ]);

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('home');
    }
}
