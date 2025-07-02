@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Novo Usuário</h1>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label>Nome</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>

            <div class="form-group mb-3">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="form-group mb-3">
                <label>Senha</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Confirmação de Senha</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection
