<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CardsRequest
 * @package App\Http\Requests
 *
 * @property string $card_title
 * @property string $card_name
 * @property string $card_number
 * @property string $card_cvv
 * @property string $card_expiration_date
 */
class CardsRequest extends FormRequest
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
            "card_title" => "required",
            "card_name" => "required",
            "card_number" => "required",
            "card_cvv" => "required",
            "card_expiration_date" => "required",
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
            "card_title" => "card_title",
            "card_name" => "card_name",
            "card_number" => "card_number",
            "card_cvv" => "card_cvv",
            "card_expiration_date" => "card_expiration_date",
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
