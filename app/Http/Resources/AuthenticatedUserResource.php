<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticatedUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $firstName = explode(' ', $this->name)[0];

        return [
            'message' => "Bienvenido {$firstName}",
            'auth_token' => $this->createToken('authToken')->plainTextToken,
            'name' => $this->name,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'sellers_limit' => $this->sellers_limit,
            'role' => $this->role,
            'status' => $this->status,
        ];
    }
}
