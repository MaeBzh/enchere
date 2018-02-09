@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Mettre un objet en vente</h4>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-warning">
                            <p >Votre quantité de crédit actuel ne vous permet pas de pouvoir mettre un objet en
                                vente.</p>
                            <p>Vous pouvez recharger votre compte en crédits depuis
                                <a href="{{ url("/mon_profil") }}" class="btn-link"> votre profil</a>
                                ou en cliquant sur le bouton suivant :
                            </p>
                        </div>

                        <a href="{{ url("/recharger_mes_credits") }}" class="btn btn-primary btn-block">Recharger mes crédits</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection