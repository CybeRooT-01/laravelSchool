<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|in:admin,prof,parent,attache'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prenom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.unique' => 'L\'email doit etre unique',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caracteres',
            'roles.required' => 'Le role est obligatoire',
            'roles.in' => 'Le role doit etre admin, prof, parent ou attache'
        ];
    }
}
