@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Mes achats
        </div>

        <div class="panel-body">
            <ul class="list-group">
                @foreach($goods as $good)
                    <li class="list-group-item">Libellé : {{ $good->titre }}</li>
                @endforeach
            </ul>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection