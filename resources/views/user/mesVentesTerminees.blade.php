@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Mes ventes terminées
        </div>

        <div class="panel-body">
            @if(count($goods) > 0)
                @foreach ($goods->chunk(4) as $chunkgoods)
                    <div class="row">
                        @foreach ($chunkgoods as $good)
                            <div class="col-md-3 portfolio-item">
                                <div class="card clickable" onclick="location.href='{{ url("objet/$good->id") }}'">
                                    <img src="{{$good->getUrlPhoto()}}" alt="Avatar" class="card-img">
                                    <div class="card-body">
                                        <h4><b>{{ ucfirst($good->titre) }}</b></h4>
                                        <p>Prix de depart : {{ $good->prix_depart }} €</p>
                                        <p>Nombre d'enchères : {{ $good->encheres()->count() }}</p>
                                        <p>Enchère terminée le : {{ $good->date_fin->format("d/m/Y à H\hi") }}</p>
                                        @if($good->acheteur()->exists())
                                            <p>Prix de vente : {{ $good->getPrix() }} €</p>
                                            <p>Acheteur : <a href="{{ url("/profil/".$good->acheteur->username) }}"
                                                             class="btn-link"> {{ ucfirst($good->acheteur->username) }} </a>
                                            </p>
                                        @else
                                            <p>Cet objet n'a pas trouvé d'acheteur</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <ul class="list-group">
                    <li class="list-group-item">Aucun objet vendus.</li>
                </ul>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection