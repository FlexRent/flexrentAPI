<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddressesRequest
 * @package App\Http\Requests
 *
 * @property string $street
 * @property string $number
 * @property string $complement
 * @property string $district
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $zipcode
 */
class AddressesRequest extends FormRequest
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
            "address_title" => "required",
            "user_id" => "required",
            "street" => "required",
            "number" => "required",
            "complement" => "required",
            "district" => "required",
            "city" => "required",
            "state" => "required",
            "country" => "required",
            "zipcode" => "required"
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
            "address_title" => "address_title",
            "street" => "street",
            "number" => "number",
            "complement" => "complement",
            "district" => "district",
            "city" => "city",
            "state" => "state",
            "country" => "country",
            "zipcode" => "zipcode"
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
