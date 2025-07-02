<?php

namespace App\Services;


use App\Models\Signatarios;

class SignatariosService
{
    public function index()
    {
        try {
            return Signatarios::with('aprovacoes.processo')->get();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function show($id)
    {
        try {
            return Signatarios::with('aprovacoes.processo')->findOrFail($id);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function store(array $data)
    {
        try {
            Signatarios::create($data);
            return "Signatarios salvo com sucesso!";
        } catch (\Exception $e) {
            return "Signatarios não foi salvo!";
        }
    }

    public function update($id, array $data)
    {
        try {
            $signatario = Signatarios::findOrFail($id);
            $signatario->update($data);
            return "Signatarios atualizado com sucesso!";
        } catch (\Exception $e) {
            return "Signatarios não foi atualizado!";
        }
    }

    public function destroy($id)
    {
        try {
            $signatario = Signatarios::findOrFail($id);
            $signatario->delete();
            return "Signatarios deletado com sucesso!";
        } catch (\Exception $e) {
            return "Signatarios não foi deletado!";
        }
    }
}
