<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessoRequest extends FormRequest
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
                'titulo' => 'nullable|string|max:255',
                'descricao' => 'nullable|string',
                'status' => 'nullable|string|in:pendente,aprovado,reprovado',
                'arquivo' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,jpeg|max:2048',
            ];
        }

        return [
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'nullable|string|in:pendente,aprovado,reprovado',
            'arquivo' => 'required|file|mimes:pdf,doc,docx,jpg,png,jpeg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título deve ter no máximo 255 caracteres.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status deve ser pendente, aprovado ou reprovado.',
            'processo_id.required' => 'O processo é obrigatório.',
            'processo_id.exists' => 'O processo selecionado não é válido.',
            'caminho_arquivo.required' => 'O caminho do arquivo é obrigatório.',
            'tipo.required' => 'O tipo do documento é obrigatório.',
            'tipo.max' => 'O tipo deve ter no máximo 100 caracteres.',
        ];
    }
}
