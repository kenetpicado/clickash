<?php

namespace App\Http\Requests\Clientarea;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RaffleAvailabilityRequest extends FormRequest
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
            'raffle_id' => $this->route('raffle'),
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
            'start_time' => 'required',
            'end_time' => 'required',
            'blocked_hours' => 'required|array|min:1',
            'raffle_id' => 'required',
            'day' => [
                'required',
                Rule::unique('availabilities')
                    ->where('user_id', auth()->id())
                    ->where('raffle_id', $this->raffle_id)
                    ->ignore($this->route('availability')),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'blocked_hours' => 'sorteos',
        ];
    }

    public function messages(): array
    {
        return [
            'day.unique' => 'Ya existe un registro para este día.',
        ];
    }
}
