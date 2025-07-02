<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @auth
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container">
                <a class="navbar-brand" href="{{ route('processos.index') }}">Processos</a>
                <a class="navbar-brand" href="{{ route('signatarios.index') }}">Signatarios</a>
                <a class="navbar-brand" href="{{ route('users.update') }}">Usuário</a>
                <div class="d-flex">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger">Sair</button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    @yield('content')
</body>

</html>
