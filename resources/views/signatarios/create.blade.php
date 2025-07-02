@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Novo Signatário</h1>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('signatarios.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required value="{{ old('nome') }}">
            </div>

            <div class="form-group mb-3">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="form-group mb-3">
                <label>Cargo</label>
                <input type="text" name="cargo" class="form-control" required value="{{ old('cargo') }}">
            </div>

            <button class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection
