<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return inertia('Clientarea/Profile/Index', [
            'user' => User::query()
                ->withCount('sellers')
                ->find(auth()->id())
        ]);
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
