<?php

namespace App\Http\Requests\API;

use App\Enums\DayEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class RaffleUserAvailabilityRequest extends FormRequest
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
            'day' => ['required', new Enum(DayEnum::class)],
            'start_time' => 'required',
            'end_time' => 'required',
            'blocked_hours' => 'required',
        ];
    }
}
