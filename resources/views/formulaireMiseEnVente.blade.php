@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Mettre un objet en vente</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/formulaireMiseEnVente') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="titre" class="col-md-4 control-label">Titre</label>
                                <div class="col-md-6">
                                    <input id="titre" type="text" class="form-control" name="titre" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Description de votre
                                    objet</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" required>
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="prix_depart" class="col-md-4 control-label">Prix de départ</label>
                                <div class="col-md-6">
                                    <input id="prix_depart" type="text" class="form-control" name="prix_depart"
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Mettre en vente
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection