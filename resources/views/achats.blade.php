@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Vos achats
        </div>

        <div class="panel-body">
            <ul class="list-group">
                @foreach($achats as $achat)
                    <li class="list-group-item">Libellé : {{ $achat->titre }}</li>
                @endforeach
            </ul>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection