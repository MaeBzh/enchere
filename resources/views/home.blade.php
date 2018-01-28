@extends('layouts.app')

@section('content')
    <h1 class="text-center">@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        Bonjour {{ ucfirst(Auth::user()->username) }} !</h1>
   {{-- <div class="panel panel-default">
        <div class="panel-heading">

        </div>
--}}
    {{--    <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav">
                        <li class="nav-item" style="cursor: pointer">
                            <a class="nav-link active" onclick="afficherProfil()">Les ventes en cours</a>
                        </li>
                        <li class="nav-item" style="cursor: pointer">
                            --}}{{--<a class="nav-link active" onclick="afficherProfil()">Votre profil</a>--}}{{--
                            <a class="nav-link active" href="{{ url("/profil") }}">Votre profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Vos ventes terminées</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Vos ventes en cours</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Vos enchères</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Vos achats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Mettre un objet en vente</a>
                        </li>
                        <li>
                            <div class="input-group">
                                <input type="text" class="form-control" id="recherche"
                                       placeholder="Rechercher un objet">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick="rechercherObjet()">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </button>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9" id="contenu">

                </div>
            </div>
        </div>--}}
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection