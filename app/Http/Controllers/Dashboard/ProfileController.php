<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return inertia("Dashboard/Profile/Index", [
            "profile" => auth()->user()
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $user = User::find(auth()->id());

        $user->fill([
            "name" => $request->name,
            "email" => $request->email
        ]);

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect()->route('dashboard.index');
    }
}
