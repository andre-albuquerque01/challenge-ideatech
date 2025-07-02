@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Processos</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <a href="{{ route('processos.create') }}" class="btn btn-primary mb-3">Novo Processo</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($processos as $processo)
                    <tr>
                        <td>{{ $processo->titulo }}</td>
                        <td>{{ $processo->status }}</td>
                        <td>
                            <a href="{{ route('processos.show', $processo->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('processos.edit', $processo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('processos.destroy', $processo->id) }}" method="POST"
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
