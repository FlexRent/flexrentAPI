<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UsersRequest
 * @package App\Http\Requests
 *
 * @property string $name
 * @property string $email
 * @property string $password
 */
class UsersRequest extends FormRequest
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
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'cpf' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            "birth_date" => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];
    }
    /**
     * Get custom attribute names for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'cpf' => 'cpf',
            'gender' => 'gender',
            'phone' => 'phone',
            "birth_date" => "birth_date",
            'email' => 'email',
            'password' => 'password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'min' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
            'unique' => 'O :attribute já está em uso.',
        ];
    }
}
