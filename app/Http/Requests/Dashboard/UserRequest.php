<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required"],
            "email" => ["required", "email", Rule::unique("users")->ignore($this->id)],
            "sellers_limit" => ["required", "numeric"],
            "company_name" => ["required",],
            'role' => ['required', new Enum(RoleEnum::class)],
            'status' => ['required', new Enum(UserStatusEnum::class)]
        ] + ($this->isMethod('post') ? $this->store() : []);
    }

    public function store()
    {
        return [
            "password" => ["required", "min:8", "confirmed"],
        ];
    }
}
