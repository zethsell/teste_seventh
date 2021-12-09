<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'min:3', 'max:255'],
            'email' => ['sometimes', 'string', 'email', Rule::unique('users')->ignore($this->route('user'))],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo Obrigatório!',
            'name.max' => 'Máximo de 255 caracteres!',
            'name.min' => 'Minimo 3 caracteres!',
            'email.required' => 'Campo Obrigatório!',
            'email.unique' => 'Já cadastrado no sistema!',
            'email.email' => 'Formato de email inválido!',
            'password.min' => 'Minimo 8 caracteres!',
            'password.confirmed' => 'As senhas inseridas não coincidem!',
            'password.required' => 'Campo Obrigatório!'
        ];
    }
}
