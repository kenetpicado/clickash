<?php

namespace App\Http\Requests\Clientarea;

use Illuminate\Foundation\Http\FormRequest;

class SellerArchingRequest extends FormRequest
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
        $this->merge([
            'seller_id' => $this->route('seller'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:RETIRO,DEPOSITO',
            'amount' => 'required|numeric|min:1',
            'week' => 'required|integer',
            'seller_id' => 'required',
        ];
    }
}
