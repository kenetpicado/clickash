<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
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
            'users' => User::whereNull('user_id')->withCount('sellers')->get(),
            'roles' => RoleEnum::cases(),
            'statuses' => UserStatusEnum::cases()
        ]);
    }

    public function show(User $user)
    {
        return inertia('Dashboard/User/Show', [
            'user' => $user,
            'sellers' => $user->sellers()->get()
        ]);
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sellers_limit' => $request->sellers_limit,
            'company_name' => $request->company_name,
            'role' => $request->role,
            'status' => UserStatusEnum::ENABLED
        ]);

        return back();
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
