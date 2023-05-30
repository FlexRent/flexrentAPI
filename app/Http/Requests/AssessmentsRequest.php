<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AssessmentsRequest
 * @package App\Http\Requests
 *
 * @property string $assessments
 * @property string $comments
 * @property int $user_id
 * @property int $product_id
 */
class AssessmentsRequest extends FormRequest
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
            "assessments_user" => "required",
            "assessments_product" => "required",
            "comments" => "required",
            "user_id" => "required",
            "product_id" => "required"
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
            "assessments_user" => "assessments",
            'assessments_product' => "assessments_product",
            "comments" => "comments",
            "user_id" => "user_id",
            "product_id" => "product_id"
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
