<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'dt_withdrawal' => $this->dt_withdrawal,
            'dt_delivery' => $this->dt_delivery,
            'daily' => $this->daily,
            'vl_safe' => $this->vl_safe,
            'vl_guarantee' => $this->vl_guarantee,
            'vl_total' => $this->vl_total,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'address_id' => $this->address_id
        ];
    }
}
