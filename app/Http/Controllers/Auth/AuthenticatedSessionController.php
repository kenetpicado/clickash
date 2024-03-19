<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\SettingResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    public function __construct(
        private readonly SettingService $settingService
    ) {
    }

    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return inertia('Auth/Login', [
            'status' => session('status'),
            'app_name' => config('app.name'),
            'terms_and_conditions' => SettingResource::make($this->settingService->getTermsAndConditions())->resolve(),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $isSeller = User::where('email', $request->email)->where('role', 'seller')->exists();

        if ($isSeller) {
            throw ValidationException::withMessages(['email' => 'No tienes permisos para acceder a esta plataforma']);
        }

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
