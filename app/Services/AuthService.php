<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    private $model = User::class;
    private $guard = 'web';
    private $field = 'email';
    private $request = null;

    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function setGuard($guard)
    {
        $this->guard = $guard;

        return $this;
    }

    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    public function login()
    {
        $user = $this->model::where($this->field, $this->request->{$this->field})->first();

        if (!$user || !Hash::check($this->request->password, $user->password)) {
            $this->request->hit();

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $this->request->clear();

        $user->tokens()->delete();

        Auth::guard($this->guard)->login($user);

        return $user;
    }
}
