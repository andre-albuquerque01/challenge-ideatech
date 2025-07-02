<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessoRequest;
use App\Services\ProcessosService;

class ProcessosController extends Controller
{
    public function __construct(private ProcessosService $processosService) {}

    public function index()
    {
        $processos = $this->processosService->index();

        if (is_null($processos)) {
            return back()->withErrors(['error' => 'Erro ao buscar os processos.']);
        }

        return view('processos.index', compact('processos'));
    }

    public function show($id)
    {
        $processo = $this->processosService->show($id);
        $logs = $this->processosService->logs($id);

        if (is_null($processo)) {
            return redirect()->route('processos.index')->withErrors(['error' => 'Processo não encontrado.']);
        }

        return view('processos.show', compact('processo', 'logs'));
    }

    public function create()
    {
        return view('processos.create');
    }

    public function store(ProcessoRequest $request)
    {
        $message = $this->processosService->store($request->validated());

        if (str_contains($message, 'não')) {
            return back()->withErrors(['error' => $message])->withInput();
        }

        return redirect()->route('processos.index')->with('success', $message);
    }

    public function edit($id)
    {
        $processo = $this->processosService->show($id);

        if (is_null($processo)) {
            return redirect()->route('processos.index')->withErrors(['error' => 'Processo não encontrado.']);
        }

        return view('processos.edit', compact('processo'));
    }

    public function update(ProcessoRequest $request, $id)
    {
        $message = $this->processosService->update($id, $request->validated());

        if (str_contains($message, 'não')) {
            return back()->withErrors(['error' => $message])->withInput();
        }

        return redirect()->route('processos.index')->with('success', $message);
    }

    public function destroy($id)
    {
        $message = $this->processosService->destroy($id);

        if (str_contains($message, 'não')) {
            return back()->withErrors(['error' => $message]);
        }

        return redirect()->route('processos.index')->with('success', $message);
    }
}
