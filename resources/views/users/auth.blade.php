@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 400px; margin: auto; padding-top: 50px;">
        <h2 class="text-center mb-4">Login</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('users.login') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" class="form-control" required autofocus
                    value="{{ old('email') }}">
            </div>

            <div class="form-group mb-3">
                <label for="password">Senha</label>
                <input id="password" type="password" name="password" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
        </form>
    </div>
@endsection
