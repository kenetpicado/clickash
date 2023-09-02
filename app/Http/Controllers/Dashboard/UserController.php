<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/User/Index', [
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return inertia('Dashboard/User/Create');
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('dashboard.users.index');
    }

    public function update(UserRequest $request, $user)
    {
        User::where('id', $user)->update($request->validated());

        return back();
    }

    public function destroy($user)
    {
        User::where('id', $user)->delete();

        return back();
    }
}
