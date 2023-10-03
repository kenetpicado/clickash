<?php

namespace App\Http\Requests\Clientarea;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->id)],
        ] + ($this->isMethod('POST') ? $this->store() : []);
    }

    public function store(): array
    {
        return [
            'password' => 'required|confirmed|min:8',
        ];
    }
}