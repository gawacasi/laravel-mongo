<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jogadores</title>
</head>
<body>
    <h1>Lista de Jogadores</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Tag</th>
                <th>Nome</th>
                <th>Troféus</th>
                <th>Vitórias</th>
                <th>Derrotas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
                <tr>
                    <td>{{ $player->tag }}</td>
                    <td>{{ $player->name }}</td>
                    <td>{{ $player->trophies }}</td>
                    <td>{{ $player->wins }}</td>
                    <td>{{ $player->losses }}</td>
                    <td>
                        <a href="{{ route('getPlayer', $player->tag) }}">Ver detalhes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
