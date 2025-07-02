<?php

namespace App\Http\Controllers;

use App\Http\Requests\AprovacoesRequest;
use App\Http\Resources\AprovacoesResource;
use App\Models\Aprovacoes;
use App\Services\AprovacoesService;
use Illuminate\Http\Request;

class AprovacoesController extends Controller
{
    public function __construct(private AprovacoesService $aprovacoesService) {}

    /* Display a listing of the resource.
     */
    public function index()
    {
        return AprovacoesResource::collection($this->aprovacoesService->index());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($idProcesso, $idSignatario)
    {
        return view('aprovacoes.create', [
            'idProcesso' => $idProcesso,
            'idSignatario' => $idSignatario,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AprovacoesRequest $request)
    {
        $message = $this->aprovacoesService->store($request->validated());

        return redirect()->route('processos.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('show', [
            'aprovacoes' => new AprovacoesResource($this->aprovacoesService->show($id))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aprovacoes $aprovacoes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aprovacoes $aprovacoes)
    {
        $message = $this->aprovacoesService->update($aprovacoes, $request->validated());

        return redirect()->route('home')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aprovacoes $aprovacoes)
    {
        $message = $this->aprovacoesService->destroy($aprovacoes);

        return redirect()->route('home')->with('message', $message);
    }
}
