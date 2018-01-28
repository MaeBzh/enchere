@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            Bonjour {{ ucfirst(Auth::user()->username) }} !
        </div>

        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item">Nom : {{ $user->nom }}</li>
                <li class="list-group-item">Prénom : {{ $user->prenom }}</li>
                <li class="list-group-item">E-mail : {{ $user->email }}</li>
            </ul>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection



