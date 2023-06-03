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
            'daily_price' => $this->daily_price,
            'images' => $this->ProductImage,
            'status' => $this->status,
            'custom_time_from' => $this->custom_time_from,
            'custom_time_until' => $this->custom_time_until,
            'rent_day' => $this->rent_day,
            "any_time" => $this->any_time,
            "product_price" => $this->product_price,
            'user_id' => $this->user_id,
            'brand_name' => $this->brand_name,
            'category' => $this->ProductCategories,
            'assessment' => $this->ProductAssessments->avg('assessments_product'),
        ];
    }
}
