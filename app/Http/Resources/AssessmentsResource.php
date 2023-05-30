<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentsResource extends JsonResource
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
            'assessments_user' => $this->assessments_user,
            'assessments_product' => $this->assessments_product,
            'comments' => $this->comments,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id
        ];
    }
}
