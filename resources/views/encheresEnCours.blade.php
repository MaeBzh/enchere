@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
           Vos enchères en cours
        </div>

        <div class="panel-body">
            <ul class="list-group">
                @foreach($encheres as $enchere)
                    <li class="list-group-item">Libellé : {{ $enchere->titre }}</li>
                @endforeach
            </ul>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection