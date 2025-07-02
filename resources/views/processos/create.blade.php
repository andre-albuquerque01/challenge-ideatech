@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar Processo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('processos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control"></textarea>
            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="pendente">Pendente</option>
                    <option value="aprovado">Aprovado</option>
                    <option value="reprovado">Reprovado</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Documento (opcional)</label>
                <input type="file" name="arquivo" class="form-control">
            </div>

            <button class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection
