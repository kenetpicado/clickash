<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class RaffleRequest extends FormRequest
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
            'settings' => 'required|array',
            'settings.individual_limit' => 'required|integer',
            'settings.general_limit' => 'required|integer',
            'settings.multiplier' => 'required|integer',
            'settings.min' => 'required',
            'settings.max' => 'required',
            'settings.super_x' => 'required|boolean',
            'settings.date' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'settings.individual_limit' => 'límite individual',
            'settings.general_limit' => 'límite general',
            'settings.multiplier' => 'multiplicador',
            'settings.min' => 'mínimo',
            'settings.max' => 'máximo',
            'settings.super_x' => 'super x',
            'settings.date' => 'fecha',
        ];
    }
}
