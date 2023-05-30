<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            "dt_withdrawal" => "required",
            "dt_delivery" => "required",
            "daily" => "required",
            "vl_safe" => "required",
            "vl_guarantee" => "required",
            "vl_total" => "required",
            "product_id" => "required",
            "address_id" => "required"
        ];
    }
}
