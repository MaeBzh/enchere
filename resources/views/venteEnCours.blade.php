@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
           Vos ventes en cours
        </div>

        <div class="panel-body">
            <ul class="list-group">
                @foreach($biens as $bien)
                    <li class="list-group-item">Libellé : {{ $bien->titre }}</li>
                @endforeach
            </ul>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection