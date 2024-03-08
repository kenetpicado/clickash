<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class BlockedNumberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        if ($this->route('raffle')) {
            $this->merge(['raffle_id' => $this->route('raffle')]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'number' => 'required',
            'settings' => 'required|array',
            'raffle_id' => 'required',
        ];
    }
}
