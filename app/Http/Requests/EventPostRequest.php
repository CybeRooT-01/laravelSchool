<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventPostRequest extends FormRequest
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
            'libelle' => 'required|string',
            'description' => 'required|string',
            'date_Evenement' => 'required|date',
        ];
    }
    public function messages(): array
    {
        return [
            'libelle.required' => 'Le libelle est obligatoire',
            'description.required' => 'La description est obligatoire',
            'date_Evenement.required' => 'La date est obligatoire',
        ];
    }
}
