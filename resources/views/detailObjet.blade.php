@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{$objet->titre}}</h4>
        </div>

        <div class="panel-body">
            <div class="media">
                <div class="media-left media-middle">
                    <img class="media-object" src="{{ asset("storage/$objet->photo") }}" alt="{{ $objet->titre }}">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Informations sur l'objet</h4>
                    <ul class="list-group">
                        <li class="list-group-item">Description : {{ $objet->description }}</li>
                        <li class="list-group-item">
                            Montant de l'enchère :
                            @if($objet->encheres->count() > 0)
                                {{ $objet->encheres()->orderBy('date_enchere', 'desc')->first()->montant }}
                            @else
                                {{ $objet->prix_depart }}
                            @endif
                            €
                        </li>
                        <li class="list-group-item">Description : {{ $objet->description }}</li>
                        <li class="list-group-item">Mise en vente le
                            : {{ $objet->date_debut->format("d/m/Y h\hi") }}</li>
                        <li class="list-group-item">Fin de l'ecnhère le
                            : {{ $objet->date_fin->format("d/m/Y h\hi") }}</li>
                        <li class="list-group-item">Vendeur
                            : {{ $objet->vendeur->nom }} {{ $objet->vendeur->prenom }}</li>
                    </ul>
                    <hr>
                    <h4>Les dernières enchères</h4>
                    <ul class="list-group">
                        @if($objet->encheres->count() > 0)
                            @foreach($objet->encheres()->limit(5)->get() as $enchere)
                                <li class="list-group-item">{{$enchere->date_enchere->format("d/m/Y h\hi")}}
                                    - {{ $enchere->acheteur->nom }} {{ $enchere->acheteur->prenom }}
                                    - {{ $enchere->montant }} €
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">Aucune enchère.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection