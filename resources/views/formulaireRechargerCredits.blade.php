@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Recharger mes credits</h4>
                    </div>
                    <div class="panel-body">
                        @if(!empty($form_error))
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                                {{ $form_error }}
                            </div>
                            <hr>
                        @endif

                        @if(!empty($form_succes))
                            <div class="alert alert-success">
                                <span class="glyphicon glyphicon-ok"></span>
                                {{ $form_succes }}
                            </div>
                            <hr>
                        @endif

                        {{-- Si le formulaire n'a pas déjà été envoyé et enregistré, on l'affiche --}}
                        @if(empty($form_succes))
                            <img class="img-responsive" style="margin: 0 auto;"
                                 src="http://i76.imgup.net/accepted_c22e0.png">
                            <hr>
                            <form role="form" method="POST" action="{{ url("/recharger_mes_credits") }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="cardNumber">Choississez l'offre qui vous convient</label>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="radio">
                                                        <label><input type="radio" name="credits" value="10" checked
                                                                      required>10 Crédits pour
                                                            10,0€ TTC
                                                            <small style="margin-left: 7px"><b>soit 1,0€ / unité</b>
                                                            </small>
                                                        </label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="radio">
                                                        <label><input type="radio" name="credits" value="25">25 Crédits
                                                            pour
                                                            22,5€ TTC
                                                            <small style="margin-left: 7px"><b>soit 0,9€ / unité</b>
                                                            </small>
                                                        </label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="radio">
                                                        <label><input type="radio" name="credits" value="50">50 Crédits
                                                            pour
                                                            40,0€ TTC
                                                            <small style="margin-left: 7px"><b>soit 0,8€ / unité</b>
                                                            </small>
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="cardNumber">Numéro de carte</label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" required autofocus/>
                                                <span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-credit-card"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">
                                            <label for="cardExpiry">Date d'expiration</label>
                                            <input type="tel" class="form-control" placeholder="MM / YY" required/>
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group">
                                            <label for="cardCVC">Code</label>
                                            <input type="tel" class="form-control" placeholder="000" required/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ url("/ventes_en_cours") }}" class="btn btn-danger btn-block">
                                            Annuler
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <button class="btn btn-success btn-block" type="submit">
                                            Valider ma commande de crédits
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection