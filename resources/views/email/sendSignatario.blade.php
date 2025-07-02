<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Solicitação de Aprovação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 30px;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            border-radius: 6px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            margin: 10px 5px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .approve {
            background-color: #28a745;
        }

        .reject {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Olá, {{ $data['nome'] }}!</h2>

        <p>Signatario designado para aprovar o seguinte processo digital:</p>

        <p><strong>Título:</strong> {{ $data['titulo'] }}</p>

        <p>Por favor, realize a análise:</p>

        <a href="{{ env('PATH_PROCESS') . '/aprovacao/' . $data['idProcesso'] . '/' . $data['idSignatario'] }}"
            class="button approve">Analisar</a>

        <p>Atenciosamente,<br>
            Sistema de Processos Digitais</p>
    </div>
</body>

</html>
