<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AprovacoesRequest extends FormRequest
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
                'processo_id' => 'nullable|exists:processos,id',
                'signatario_id' => 'nullable|exists:signatarios,id',
                'status' => 'nullable|string|in:aprovado,reprovado',
                'justificativa' => 'nullable|string',
                'data_aprovacao' => 'nullable|date',
            ];
        }

        return [
            'processo_id' => 'required|exists:processos,id',
            'signatario_id' => 'required|exists:signatarios,id',
            'status' => 'required|string|in:aprovado,reprovado',
            'justificativa' => 'nullable|string',
            'data_aprovacao' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'processo_id.required' => 'O processo é obrigatório.',
            'processo_id.exists' => 'O processo selecionado não é válido.',
            'signatario_id.required' => 'O signatário é obrigatório.',
            'signatario_id.exists' => 'O signatário selecionado não é válido.',
            'status.required' => 'O status da aprovação é obrigatório.',
            'status.in' => 'O status deve ser aprovado ou reprovado.',
            'data_aprovacao.date' => 'A data de aprovação deve ser uma data válida.',
        ];
    }
}
