@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Mes ventes terminées
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
                                        <p>Prix de depart : {{ $good->prix_depart }} €
                                            <br>Nombre d'enchères : {{ $good->encheres()->count() }}
                                            <br>Enchère terminée le : {{ $good->date_fin->format("d/m/Y à H\hi") }}
                                            @if($good->acheteur()->exists())
                                                <br>Prix de vente : {{ $good->getPrix() }} €
                                                <br>Acheteur : {{ $good->acheteur->username }}
                                            @else
                                                <br>Cet objet n'a pas trouvé d'acheteur
                                            @endif
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
                    <li class="list-group-item">Aucun objet vendus.</li>
                </ul>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection