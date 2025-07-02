@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nova Aprovação</h1>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('aprovacoes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="processo_id" value="{{ $idProcesso }}">
            <input type="hidden" name="signatario_id" value="{{ $idSignatario }}">

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="aprovado">Aprovado</option>
                    <option value="reprovado">Reprovado</option>
                    <option value="pendente">Pendente</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Justificativa</label>
                <textarea name="justificativa" class="form-control">{{ old('justificativa') }}</textarea>
            </div>

            <button class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection
