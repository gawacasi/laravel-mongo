<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $player['name'] }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>{{ $player['name'] }}</h1>
        <p>Tag: {{ $player['tag'] }}</p>
        <p>Troféus: {{ $player['trophies'] }}</p>
        <p>Vitórias: {{ $player['wins'] }}</p>
        <p>Derrotas: {{ $player['losses'] }}</p>
        <a href="/" class="btn btn-primary">Voltar</a>
    </div>
</body>
</html>
