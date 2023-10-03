<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'raffle_id' => ['required', 'exists:raffles,id'],
            'digit' => ['required'],
            'amount' => ['required', 'numeric'],
            'hour' => ['required', 'date_format:H:i:s'],
            'client' => ['required'],
        ];
    }
}
