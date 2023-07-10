<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sortiePutRequest extends FormRequest
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
            'id' => 'required|array|',
        ];
    }
    public function messages(): array
    {
        return [
            'id.required' => 'Le champ id est obligatoire',
            'id.array' => 'Le champ id doit etre un tableau',
        ];
    }
}
