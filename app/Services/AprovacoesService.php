<?php

namespace App\Services;

use App\Models\Aprovacoes;
use App\Models\Processos;

class AprovacoesService
{
    public function index()
    {
        try {
            return Aprovacoes::with(['processo', 'signatario'])
                ->orderBy('data_aprovacao', 'desc')
                ->get();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function show($id)
    {
        try {
            return Aprovacoes::with(['processo', 'signatario'])->findOrFail($id);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function store(array $data)
    {
        try {
            $data['data_aprovacao'] = now();
            Aprovacoes::create($data);

            $processo = Processos::findOrFail($data['processo_id']);
            $processo->update([
                'status' => $data['status'],
            ]);
            return "Aprovação salva com sucesso!";
        } catch (\Exception $e) {
            return "Aprovação não foi salva!";
        }
    }

    public function update($id, array $data)
    {
        try {
            $aprovacao = Aprovacoes::findOrFail($id);
            $aprovacao->update($data);
            return "Aprovação atualizada com sucesso!";
        } catch (\Exception $e) {
            return "Aprovação não foi atualizada!";
        }
    }
    public function destroy($id)
    {
        try {
            $aprovacao = Aprovacoes::findOrFail($id);
            $aprovacao->delete();
            return "Aprovação deletada com sucesso!";
        } catch (\Exception $e) {
            return "Aprovação não foi deletada!";
        }
    }
}
