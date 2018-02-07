@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{$good->titre}}</h4>
        </div>

        <div class="panel-body">
            <div class="media">
                <div class="media-left media-top">
                    <img class="media-object" src="{{ $good->getUrlPhoto() }}">
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
                        <li class="list-group-item">
                            @if(!$good->isTermine())
                                Fin de l'enchère dans : {{ $good->getTempsRestant() }}
                            @else
                                Enchère terminée le : {{ $good->date_fin->format("d/m/Y à h\hi") }}
                            @endif
                        </li>
                        <li class="list-group-item">Vendeur : <a
                                    href="{{ url("/profil/".$good->vendeur->username) }}">{{ ucfirst($good->vendeur->username) }}</a>
                        </li>
                        @if($good->vendeur_id != Auth::user()->id)
                            <li class="list-group-item">
                                @if($good->isTermine())
                                    <button class="btn btn-primary disabled btn-block">Enchère terminée</button>
                                @elseif($good->encheres()->orderBy("id", "desc")->exists() &&
                                $good->encheres()->orderBy("id", "desc")->first()->acheteur_id == Auth::user()->id)
                                    <button class="btn btn-success disabled btn-block"><span
                                                class="glyphicon glyphicon-ok"></span> Vous êtes actuellement le
                                        meilleur enchérisseur
                                    </button>
                                @else
                                    <button class="btn btn-primary btn-block">Faire une enchère</button>
                                @endif
                            </li>
                        @endif
                    </ul>
                    <hr>
                    <h4>Les dernières enchères</h4>

                    @if($good->encheres->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-align-middle">
                                <thead>
                                <tr>
                                    <th>Date de l'enchère</th>
                                    <th>Montant de l'enchère</th>
                                    <th>Enchérisseur</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($good->encheres()->orderBy("id", "desc")->limit(5)->get() as $enchere)
                                    <tr>
                                        <td>{{$enchere->date_enchere->format("d/m/Y h\hi")}}</td>
                                        <td>{{ $enchere->montant }} €</td>
                                        <td><a href="{{ url("/profil/".$enchere->acheteur->username) }}"
                                               class="btn-link">{{ ucfirst($enchere->acheteur->username) }}</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <ul class="list-group">
                            <li class="list-group-item">Aucune enchère.</li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection