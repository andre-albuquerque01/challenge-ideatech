@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Processo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('processos.update', $processo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Título</label>
                <input type="text" name="titulo" value="{{ old('titulo', $processo->titulo) }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control">{{ old('descricao', $processo->descricao) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="pendente" @selected($processo->status == 'pendente')>Pendente</option>
                    <option value="aprovado" @selected($processo->status == 'aprovado')>Aprovado</option>
                    <option value="reprovado" @selected($processo->status == 'reprovado')>Reprovado</option>
                </select>
            </div>

            <button class="btn btn-primary">Atualizar</button>
        </form>
    </div>
@endsection
