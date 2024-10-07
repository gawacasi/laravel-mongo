<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Jogador</title>
</head>
<body>
    <h1>Detalhes do Jogador</h1>

    @if(isset($player))
        <p><strong>Nome:</strong> {{ $player['name'] }}</p>
        <p><strong>Tag:</strong> {{ $player['tag'] }}</p>
        <p><strong>Troféus:</strong> {{ $player['trophies'] }}</p>
        <p><strong>Vitórias:</strong> {{ $player['wins'] }}</p>
        <p><strong>Derrotas:</strong> {{ $player['losses'] }}</p>
    @else
        <p>Jogador não encontrado.</p>
    @endif

    <a href="{{ route('allPlayers') }}">Voltar à lista de jogadores</a>
</body>
</html>
