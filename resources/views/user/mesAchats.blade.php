@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Mes achats
        </div>

        <div class="panel-body">
            @if(count($goods) > 0)
                <div class="table-responsive">
                    <table class="table table-align-middle">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Miniature</th>
                            <th>Titre</th>
                            <th>Prix</th>
                            <th>Nombre d'enchères</th>
                            <th>Date d'achat</th>
                            <th>Vendeur</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goods as $good)
                            <tr>
                                <td><a href="{{ url("/objet/$good->id") }}" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-search"></span></a></td>
                                <td><img src="{{ $good->getUrlPhoto() }}" class="img-responsive" width="64px" ></td>
                                <td>{{$good->titre}}</td>
                                <td>{{$good->getPrix()}} €</td>
                                <td>{{ $good->encheres()->count() }}</td>
                                <td>{{$good->date_fin->format("d/m/Y à H\hi")}}</td>
                                <td><a href="{{ url("/profil/".$good->vendeur->username) }}"
                                       class="btn-link">{{ ucfirst($good->vendeur->username) }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <ul class="list-group">
                    <li class="list-group-item">Aucun achat effectué.</li>
                </ul>
            @endif

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection