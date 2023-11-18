<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class BulkTransactionRequest extends FormRequest
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
            'raffle_id' => 'required',
            'client' => 'nullable',
            'data' => 'required|array|min:1',
            'data.*.digit' => 'required',
            'data.*.amount' => 'required|numeric|min:1',
            'data.*.hour' => 'required',
            'data.*.super_x' => 'required|boolean',
        ];
    }
}
