<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignatarioRequest;
use App\Services\SignatariosService;
use Illuminate\Http\Request;

class SignatariosController extends Controller
{

    public function __construct(private SignatariosService $signatariosService) {}

    public function index()
    {
        $signatarios = $this->signatariosService->index();
        if (is_null($signatarios)) {
            return back()->withErrors(['error' => 'Erro ao buscar signatários.']);
        }

        return view('signatarios.index', compact('signatarios'));
    }

    public function show($id)
    {
        $signatario = $this->signatariosService->show($id);

        if (is_null($signatario)) {
            return redirect()->route('signatarios.index')->withErrors(['error' => 'Signatário não encontrado.']);
        }

        return view('signatarios.show', compact('signatario'));
    }

    public function create()
    {
        return view('signatarios.create');
    }

    public function store(SignatarioRequest $request)
    {
        $message = $this->signatariosService->store($request->validated());

        if (str_contains($message, 'não')) {
            return back()->withErrors(['error' => $message])->withInput();
        }

        return redirect()->route('signatarios.index')->with('success', $message);
    }

    public function edit($id)
    {
        $signatario = $this->signatariosService->show($id);

        if (is_null($signatario)) {
            return redirect()->route('signatarios.index')->withErrors(['error' => 'Signatário não encontrado.']);
        }

        return view('signatarios.edit', compact('signatario'));
    }

    public function update(SignatarioRequest $request, $id)
    {
        $message = $this->signatariosService->update($id, $request->validated());

        if (str_contains($message, 'não')) {
            return back()->withErrors(['error' => $message])->withInput();
        }

        return redirect()->route('signatarios.index')->with('success', $message);
    }

    public function destroy($id)
    {
        $message = $this->signatariosService->destroy($id);

        if (str_contains($message, 'não')) {
            return back()->withErrors(['error' => $message]);
        }

        return redirect()->route('signatarios.index')->with('success', $message);
    }
}
