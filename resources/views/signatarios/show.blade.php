@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Signatário</h1>

        <p><strong>Nome:</strong> {{ $signatario->nome }}</p>
        <p><strong>E-mail:</strong> {{ $signatario->email }}</p>
        <p><strong>Cargo:</strong> {{ $signatario->cargo }}</p>
        <h2>Aprovações</h2>
        @if ($signatario->aprovacoes->isEmpty())
            <p>Nenhuma aprovação registrada.</p>
        @else
            <ul>
                @foreach ($signatario->aprovacoes as $aprovacao)
                    <li>
                        <strong>Processo:</strong> {{ $aprovacao->processo->titulo }}<br>
                        <strong>Status:</strong> {{ $aprovacao->status }}<br>
                        <strong>Data de Aprovação:</strong>
                        {{ $aprovacao->data_aprovacao ? $aprovacao->data_aprovacao->format('d/m/Y H:i:s') : 'N/A' }}
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('signatarios.index') }}" class="btn btn-secondary mt-3">Voltar</a>
    </div>
@endsection
