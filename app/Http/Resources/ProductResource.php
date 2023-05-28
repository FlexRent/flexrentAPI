<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'model' => $this->model,
            'price' => $this->price,
            'image' => $this->image,
            'status' => $this->status,
            'withdrawal_week' => $this->withdrawal_week,
            'delivery_week' => $this->delivery_week,
            'weekend_withdrawal' => $this->weekend_withdrawal,
            'weekend_delivery' => $this->weekend_delivery,
            'user_id' => $this->user_id,
        ];
    }
}
