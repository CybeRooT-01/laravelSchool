<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoefPostRequest extends FormRequest
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
            'note_max' => 'required|numeric',
            'evaluation_id' => 'required|numeric',
            'classe_id' => 'required|numeric',
            'annee_scolaire_id' => 'required|numeric',
            'discipline_id' => 'required|numeric'
        ];
    }
    public function messages():array
    {
        return [
            'note_max.required' => 'La note maximale est obligatoire',
            'evaluation_id.required' => 'L\'evaluation est obligatoire',
            'classe_id.required' => 'La classe est obligatoire',
            'annee_scolaire_id.required' => 'L\'annee scolaire est obligatoire',
            'discipline_id.required' => 'La discipline est obligatoire',
        ];
    }
}
