<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElevePostRequest extends FormRequest
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
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'sexe' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prenom est obligatoire',
            'date_naissance.required' => 'La date de naissance est obligatoire',
            'lieu_naissance.required' => 'Le lieu de naissance est obligatoire',
            'sexe.required' => 'Le sexe est obligatoire',
        ];
    }
}
