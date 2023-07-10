@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $classe->nom }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>nom</th>
                <th>prenom</th>
                <th>Date de naissance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classe->inscriptions as $inscription)
            <tr>
                <td>{{ $inscription->eleve->nom }}</td>
                <td > {{ $inscription->eleve->prenom }}</td>
                <td>{{ date('j/m/Y', strtotime($inscription->eleve->date_naissance)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
