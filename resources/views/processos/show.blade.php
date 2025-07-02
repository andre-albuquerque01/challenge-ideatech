@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Processo</h1>

        <p><strong>Título:</strong> {{ $processo->titulo }}</p>
        <p><strong>Descrição:</strong> {{ $processo->descricao }}</p>
        <p><strong>Status:</strong> {{ $processo->status }}</p>

        @if ($processo->documentos->count())
            <h4>Documentos</h4>
            <ul>
                @foreach ($processo->documentos as $doc)
                    <li>
                        {{ $doc->tipo }} -
                        <a href="{{ asset('storage/document/' . $doc->caminho_arquivo) }}" target="_blank">Ver
                            documento</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <h2>Aprovações</h2>
        @if ($processo->aprovacoes->isEmpty())
            <p>Nenhuma aprovação registrada.</p>
        @else
            <ul>
                @foreach ($processo->aprovacoes as $aprovacao)
                    <li>
                        <strong>Processo:</strong> {{ $aprovacao->processo->titulo }}<br>
                        <strong>Status:</strong> {{ $aprovacao->status }}<br>
                        <strong>Data de Aprovação:</strong>
                        {{ $aprovacao->data_aprovacao ? $aprovacao->data_aprovacao->format('d/m/Y H:i:s') : 'N/A' }}
                    </li>
                @endforeach
            </ul>
        @endif

        <h4 class="mt-4">Histórico de Alterações</h4>

        @if ($logs->isEmpty())
            <p>Nenhuma alteração registrada.</p>
        @else
            <ul class="list-group">
                @foreach ($logs as $log)
                    <li class="list-group-item mb-2">
                        <strong>{{ $log->description }}</strong><br>
                        <small>
                            Alterado por: {{ $log->causer?->name ?? 'Sistema' }}<br>
                            Em: {{ $log->created_at->format('d/m/Y H:i:s') }}
                        </small>

                        @if ($log->properties->has('attributes'))
                            <ul class="mt-2">
                                @foreach ($log->properties['attributes'] as $field => $value)
                                    @php
                                        $old = $log->properties['old'][$field] ?? '—';
                                    @endphp
                                    <li><strong>{{ ucfirst($field) }}:</strong> {{ $old }} → {{ $value }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('processos.index') }}" class="btn btn-secondary mt-3">Voltar</a>
    </div>
@endsection
