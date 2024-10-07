<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Info</title>
</head>
<body>
    <h1>Player Information</h1>

    @if(isset($player['error']))
        <p>Error: {{ $player['error'] }}</p>
    @else
        <p>Name: {{ $player['name'] }}</p>
        <p>Tag: {{ $player['tag'] }}</p>
        <p>Trophies: {{ $player['trophies'] }}</p>
        <p>Wins: {{ $player['wins'] }}</p>
        <p>Losses: {{ $player['losses'] }}</p>
        <p>Clan: {{ $player['clan']['name'] ?? 'No Clan' }}</p>
        <p>Level: {{ $player['level'] }}</p>
        <!-- Adicione mais campos conforme necessário -->
    @endif
</body>
</html>
