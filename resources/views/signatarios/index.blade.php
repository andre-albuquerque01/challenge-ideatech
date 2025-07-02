@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Signatários</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <a href="{{ route('signatarios.create') }}" class="btn btn-primary mb-3">Novo Signatário</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Cargo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($signatarios as $signatario)
                    <tr>
                        <td>{{ $signatario->nome }}</td>
                        <td>{{ $signatario->email }}</td>
                        <td>{{ $signatario->cargo }}</td>
                        <td>
                            <a href="{{ route('signatarios.show', $signatario->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('signatarios.edit', $signatario->id) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('signatarios.destroy', $signatario->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
