<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SellerReportRequest extends FormRequest
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
            'raffle_id' => ['required', 'integer'],
            'hour' => ['required', 'date_format:H:i:s'],
            'date' => ['nullable', 'date'],
        ];
    }
}
