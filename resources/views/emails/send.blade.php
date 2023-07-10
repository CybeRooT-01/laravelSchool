<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Nouvel événement : {{ $event['titre'] }}</title>
</head>
<body>
    <h1>Nouvel événement : {{ $event['titre'] }}</h1>
    @if($event['sexEleve'] == 'M')
    <p>Bonjour Monsieur  nous vous faisons part de notre evenement {{ $event['description'] }} le  {{$event['date']}}</p>
    @elseif($event['sexEleve'] == 'F')
    <p>Bonjour Madame  nous vous faisons part de notre evenement {{ $event['description'] }} le  {{$event['date']}}</p>
    @endif
</body>
</html>
