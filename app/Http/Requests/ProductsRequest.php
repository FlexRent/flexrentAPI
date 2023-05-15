<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            "name" => "required",
            "description" => "required",
            "model" => "required",
            "price" => "required",
            "image" => "required",
            "status" => "required",
            "withdrawal_week" => "required",
            "delivery_week" => "required",
            "weekend_withdrawal" => "required",
            "weekend_delivery" => "required"
            // "imame" => "required"
            // "imame" => "required"
            // "imame" => "required"

        ];
    }
}