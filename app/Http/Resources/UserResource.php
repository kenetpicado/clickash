<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'company_name' => $this->company_name ?? 'N/A',
            'role' => $this->role,
            'status' => $this->status,
            'sellers_limit' => $this->sellers_limit,
            'sellers_count' => $this->sellers()->count()
        ];
    }
}
