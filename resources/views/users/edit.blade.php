@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Usuário</h1>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('users.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nome</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
            </div>

            <div class="form-group mb-3">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
            </div>

            <div class="form-group mb-3">
                <label>Nova Senha (deixe vazio para não alterar)</label>
                <input type="password" name="new_password" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Senha Atual (obrigatório para alterar)</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary">Atualizar</button>
        </form>
    </div>
@endsection
