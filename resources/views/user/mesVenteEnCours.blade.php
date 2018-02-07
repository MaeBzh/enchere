@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Mes ventes en cours
        </div>

        <div class="panel-body">
            @if(count($goods) > 0)
                @foreach ($goods->chunk(2) as $chunkgoods)
                    <div class="row">
                        @foreach ($chunkgoods as $good)
                            <div class="col-md-6">
                                <div class="media btn btn-default"
                                     onclick="location.href='{{ url("objet/$good->id") }}'">
                                    <div class="media-left">
                                        <img class="media-object" src="{{ $good->getUrlPhoto() }}"
                                             style="width:auto;height:100px">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $good->titre }}</h4>
                                        <p>Prix actuel : {{ $good->getPrix() }} €
                                            <br>Nombre d'enchères : {{ $good->encheres()->count() }}
                                            <br>Fin de l'enchère dans : {{ $good->getTempsRestant() }}
                                            <br>Vendeur : <a href="{{ url("/profil/".$good->vendeur->username) }}"
                                                             class="btn-link">
                                                {{ ucfirst($good->vendeur->username) }} </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            @else
                <ul class="list-group">
                    <li class="list-group-item">Aucun objet en vente actuellement.</li>
                </ul>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection