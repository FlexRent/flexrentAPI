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
            "price" => "price",
            "image" => "image",
            "status" => "status",
            "withdrawal_week" => "withdrawal_week",
            "delivery_week" => "delivery_week",
            "weekend_withdrawal" => "weekend_withdrawal",
            "weekend_delivery" => "weekend_delivery"
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
