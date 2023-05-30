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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'cpf' => $this->cpf,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
            'email' => $this->email,
            'remember_token' => $this->remember_token,
            'assessment' => $this->UserAssessments->avg('assessments_user'),
        ];
    }
}
