<?php

namespace App\Http\Requests\Clientarea;

use Illuminate\Foundation\Http\FormRequest;

class RaffleAvailabilityRequest extends FormRequest
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
            "start_time" => "required",
            "end_time" => "required",
            "blocked_hours" => "required|array|min:1",
        ] + ($this->isMethod('POST') ? $this->store() : []);
    }

    public function store()
    {
        return [
            "order" => "required|numeric",
            "day" => "required",
        ];
    }

    public function attributes(): array
    {
        return [
            "blocked_hours" => "sorteos",
        ];
    }
}
