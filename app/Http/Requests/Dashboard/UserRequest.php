<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\RoleEnum;
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
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255", Rule::unique("users")->ignore($this->id)],
            "password" => ["required_if:method,post", "string", "min:8", "confirmed"],
            "sellers_limit" => ["required", "numeric"],
            "company_name" => ["required", "string", "max:255"],
            'role' => ['required', new Enum(RoleEnum::class)],
        ];
    }
}
