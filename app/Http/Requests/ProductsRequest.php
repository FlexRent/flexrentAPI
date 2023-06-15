<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductsRequest
 * @package App\Http\Requests
 *
 * @property string $name
 * @property string $description
 * @property string $model
 * @property float $daily_price
 * @property string $image
 * @property string $status
 * @property string $custom_time_from
 * @property string $custom_time_until
 */
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
            "daily_price" => "required",
            // "images" => "required",
            "product_price" => "required",
            "rent_day" => "required",
            // "image" => "required",
            "status" => "required",
            "brand_name" => "required",
            "category_id" => "required",
        ];
    }

    /**
     * Pega os nomes de atributos personalizados para erros do validador.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            "name" => "name",
            "description" => "description",
            "model" => "model",
            "daily_price" => "daily_price",
            "product_price" => "product_price",
            "any_time" => "any_time",
            // "image" => "image",
            "status" => "status",
            "custom_time_from" => "custom_time_from",
            "custom_time_until" => "custom_time_until",
            "rent_day" => "rent_day",
            "brand_name" => "brand_name",
            "category_id" => "category_id",
            // "brand_id" => "brand_id"
        ];
    }

    /**
     * Pega as mensagens de erro para as regras de validação definidas.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            "required" => "O campo ':attribute' é obrigatório.",
        ];
    }
}
