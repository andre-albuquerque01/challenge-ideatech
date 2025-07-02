<?php

namespace App\Services;

use App\Jobs\SendEmailSignatarioJob;
use App\Models\Documentos;
use App\Models\Processos;
use App\Models\Signatarios;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class ProcessosService
{
    public function index()
    {
        try {

            return Processos::with(['aprovacoes', 'documentos'])->get();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function show($id)
    {
        return Processos::with(['aprovacoes', 'documentos'])->findOrFail($id);
    }

    public function store(array $data)
    {
        try {
            $processos = Processos::create($data);
            if (isset($data['arquivo'])) {
                $document = $this->saveDocument($data);
                Documentos::create([
                    'processo_id' => $processos->id,
                    'caminho_arquivo' => $document['caminho_arquivo'],
                    'tipo' => $document['tipo'],
                ]);

                $signatarios = Signatarios::all();
                foreach ($signatarios as $signatario) {
                    dispatch(new SendEmailSignatarioJob($processos, $signatario));
                }
            }

            return "Processos salvo com sucesso!";
        } catch (\Exception $e) {
            dd($e->getMessage());
            return "Processos não foi salvo!";
        }
    }

    public function update($id, array $data)
    {
        try {
            $processos = Processos::findOrFail($id);
            $processos->update($data);
            return "Processos atualizado com sucesso!";
        } catch (\Exception $e) {
            return "Processos não foi atualizado!";
        }
    }

    public function destroy($id)
    {
        try {
            $signatario = Processos::findOrFail($id);
            $signatario->delete();
            return "Processos deletado com sucesso!";
        } catch (\Exception $e) {
            return "Processos não foi deletado!";
        }
    }

    public function saveDocument(array $data)
    {
        if (isset($data['arquivo'])) {
            $documento = $data['arquivo'];
            $typeDocument = $documento->getClientOriginalExtension();
            if ($typeDocument != null) {
                $newName_documento = uniqid() . "." . $typeDocument;
                Storage::disk('public')->put('document/' . $newName_documento, file_get_contents($documento));
                return ['caminho_arquivo' => $newName_documento, 'tipo' => $typeDocument];
            } else {
                return ['caminho_arquivo' => null, 'tipo' => null];
            }
        } else {
            return ['caminho_arquivo' => null, 'tipo' => null];
        }
    }

    public function logs($id)
    {
        return Activity::where('subject_type', Processos::class)
            ->where('subject_id', $id)
            ->latest()
            ->get();
    }
}
