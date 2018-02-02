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

                        @if(!empty($form_error))
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                                {{ $form_error }}
                            </div>
                        @endif

                        @if(!empty($form_succes))
                            <div class="alert alert-success">
                                <span class="glyphicon glyphicon-ok"></span>
                                {{ $form_succes }}
                                <a href="{{ url($good_url) }}" class="btn btn-success">Voir l'objet</a>
                            </div>
                        @endif

                        {{-- Si le formulaire n'a pas déjà été envoyé et enregistré, on l'affiche --}}
                        @if(empty($form_succes))
                            <div class="alert alert-info">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                Les objets sont mis en vente pour une durée de 7 jours.
                            </div>
                            <form class="form-horizontal" method="POST" action="{{ url('/formulaireMiseEnVente') }}"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group raw">
                                    <label for="titre" class="col-md-4 control-label">Titre</label>
                                    <div class="col-md-6">
                                        <input id="titre" type="text" class="form-control" name="titre" required
                                               autofocus>
                                    </div>
                                </div>

                                <div class="form-group raw">
                                    <label for="description" class="col-md-4 control-label">Description de votre
                                        objet</label>
                                    <div class="col-md-6">
                                        <textarea id="description" class="form-control" name="description"
                                                  required></textarea>
                                    </div>
                                </div>

                                <div class="form-group raw">
                                    <label for="prix_depart" class="col-md-4 control-label">Prix de départ</label>
                                    <div class="col-md-6">
                                        <input id="prix_depart" type="number" class="form-control" name="prix_depart"
                                               required min="0.00" step="0.01">
                                    </div>
                                </div>

                                <div class="form-group raw">
                                    <label for="photo" class="col-md-4 control-label">Photo de l'objet</label>
                                    <div class="col-md-6">
                                        <input id="photo" type="file" class="btn btn-primary btn-block" name="photo"
                                               required accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*">
                                        <p class="help-block">Extensions autorisées : jpg, png, gif, bmp.</p>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection