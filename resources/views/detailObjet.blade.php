@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{$good->titre}}</h4>
        </div>

        <div class="panel-body">
            <div class="media">
                <div class="media-left media-top">
                    @if(empty($good->photo))
                        <img class="media-object" src="{{ asset("img_empty.png") }}"
                             style="width:auto;height:200px">
                    @else
                        <img class="media-object" src="{{ asset("storage/$good->photo") }}"
                             style="width:auto;height:200px">
                    @endif
                    @if(!$good->isTermine())
                    <button class="btn btn-primary btn-block">Faire une enchère</button>
                    @else
                        <button class="btn btn-primary disabled btn-block">Enchère terminée</button>
                    @endif
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Informations sur l'objet</h4>
                    <ul class="list-group">
                        <li class="list-group-item">Titre : {{ $good->titre }}</li>
                        <li class="list-group-item">
                            Montant de l'enchère : {{ $good->getPrix() }} €
                        </li>
                        <li class="list-group-item">Description : {{ $good->description }}</li>
                        <li class="list-group-item">Mise en vente le
                            : {{ $good->date_debut->format("d/m/Y h\hi") }}</li>
                        <li class="list-group-item">Fin de l'enchère le
                            : {{ $good->date_fin->format("d/m/Y h\hi") }}</li>
                        <li class="list-group-item">Vendeur : <a href="{{ url("/profil/".$good->vendeur->username) }}">{{ ucfirst($good->vendeur->username) }}</a></li>
                    </ul>
                    <hr>
                    <h4>Les dernières enchères</h4>
                    <ul class="list-group">
                        @if($good->encheres->count() > 0)
                            @foreach($good->encheres()->limit(5)->get() as $enchere)
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