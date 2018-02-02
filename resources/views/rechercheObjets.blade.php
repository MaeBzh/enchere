@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Votre recherche
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table id="resultatRecherche">
                    <tr class="titreColonne row">
                        <td class="col-md-3">Titre</td>
                        <td class="col-md-2">Photo</td>
                        <td class="col-md-4">Description</td>
                        <td class="col-md-3">Vendu par</td>
                    </tr>

                    @if(count($recherche) > 0)
                        @foreach($recherche as $objet)
                            <tr>
                                <td><a href="{{url("/objet/$objet->id")}}"> {{ $objet->titre }} </a></td>
                                <td></td>
                                <td> {{ $objet->description }}</td>
                                <td> {{ $objet->vendeur->nom }} {{ $objet->vendeur->prenom }}</td>
                            </tr>
                        @endforeach
                </table>
            </div>
            @else
                <p>Aucun resultat.</p>
            @endif


        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection