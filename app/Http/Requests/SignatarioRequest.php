<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignatarioRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('put')) {
            return [
                'nome' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:signatarios,email,' . $this->route('signatario'),
                'cargo' => 'nullable|string|max:255',
            ];
        }

        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:signatarios,email',
            'cargo' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'cargo.required' => 'O cargo é obrigatório.',
        ];
    }
}
