@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <h1>Detalhes do Usuário</h1>

        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>E-mail:</strong> {{ $user->email }}</p>

        <a href="{{ route('users.edit') }}" class="btn btn-secondary mt-3">Editar</a>
    </div>
@endsection
