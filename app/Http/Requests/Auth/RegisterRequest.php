<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:6|same:passwordConfirm',
            'passwordConfirm' => 'min:6|required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nome completo',
            'email' => 'email',
            'password' => 'senha',
            'passwordConfirm' => 'confirmar senha'
        ];
    }
}
