@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Mes enchères en cours
        </div>

        <div class="panel-body">
            @if(count($encheres) > 0)
                <div class="table-responsive">
                    <table class="table table-align-middle">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Miniature</th>
                            <th>Titre</th>
                            <th>Prix actuel</th>
                            <th>Ma meilleur offre</th>
                            <th>Statut</th>
                            <th>Nombre d'enchères</th>
                            <th>Temps restant</th>
                            <th>Vendeur</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($encheres as $enchere)
                            @php $good = $enchere->bien @endphp
                            <tr>
                                <td><a href="{{ url("/objet/$good->id") }}" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-search"></span></a></td>
                                <td><img src="{{ $good->getUrlPhoto() }}" class="img-responsive" width="64px"></td>
                                <td>{{$good->titre}}</td>
                                <td>{{$good->getPrix()}} €</td>
                                @php
                                    $my_last_enchere = $good->encheres()->where("acheteur_id", Auth::user()->id)->orderBy("id","desc")->first();
                                @endphp
                                <td>{{$my_last_enchere->montant}} €</td>
                                @php
                                    $last_enchere = $good->encheres()->orderBy("id","desc")->first();
                                @endphp
                                <td>
                                    @if($last_enchere->acheteur_id == Auth::user()->id)
                                        <div class="alert alert-success">
                                            <span class="glyphicon glyphicon-ok"></span> Vous gagnez l'enchère
                                        </div>
                                    @else
                                        <div class="alert alert-danger">
                                            <span class="glyphicon glyphicon-remove"></span> Vous perdez l'enchère
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $good->encheres()->count() }}</td>
                                <td>
                                    {{ $good->getTempsRestant() }}
                                </td>
                                <td><a href="{{ url("/profil/".$good->vendeur->username) }}"
                                       class="btn-link">{{ ucfirst($good->vendeur->username) }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <ul class="list-group">
                    <li class="list-group-item">Aucune enchère en cours.</li>
                </ul>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection