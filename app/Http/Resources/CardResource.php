<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "card_title" => $this->card_title,
            "card_name" => $this->card_name,
            "card_number" => $this->card_number,
            "card_cvv" => $this->card_cvv,
            "card_expiration_date" => $this->card_expiration_date,
            "user_id" => $this->user_id,
        ];
    }
}
