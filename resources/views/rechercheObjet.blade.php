@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Recherche : {{ request("recherche") }}
        </div>

        <div id="recherche" class="panel-body">

            @if(count($recherche) > 0)
                @foreach ($recherche->chunk(4) as $goods)
                    <div class="row">
                        @foreach ($goods as $good)
                            <div class="col-md-3 portfolio-item">
                                <div class="card clickable" onclick="location.href='{{ url("objet/$good->id") }}'">
                                    <img src="{{$good->getUrlPhoto()}}" alt="Avatar" class="card-img">
                                    <div class="card-body">
                                        <h4><b>{{ ucfirst($good->titre) }}</b></h4>
                                        <p>Prix actuel : {{ $good->getPrix() }} €</p>
                                        <p>Nombre d'enchères : {{ $good->encheres()->count() }}</p>
                                        <p>Termine dans : {{ $good->getTempsRestant() }}</p>
                                        <p>Vendeur : <a href="{{ url("/profil/".$good->vendeur->username) }}"
                                                        class="btn-link"> {{ ucfirst($good->vendeur->username) }} </a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <ul class="list-group">
                    <li class="list-group-item">Aucun résultat ne correspond à votre recherche.</li>
                </ul>
            @endif
        </div>
    </div>
@endsection