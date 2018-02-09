<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/confirmerInscription/{inscriptionToken}', 'Auth\RegisterController@confirmationInscription');

// Toutes les routes faisant partie de se groupe sont innaccessibles pour un visiteur non authentifié
Route::middleware("auth")->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/mon_profil', 'UserController@afficherMonProfil');
    Route::get('/mes_ventes_en_cours', 'UserController@afficherMesVentesEnCours');
    Route::get('/mes_ventes_terminees', 'UserController@afficherMesVentesTerminees');
    Route::get('/mes_achats', 'UserController@afficherMesAchats');
    Route::get('/mes_encheres_en_cours', 'UserController@afficherMesEncheresEnCours');
    Route::get('/profil/{username}', 'UserController@afficherProfil');

    Route::get('/mettre_en_vente', 'GoodController@afficherFormulaireMiseEnVente');
    Route::post('/mettre_en_vente', 'GoodController@traiterFormulaireMiseEnVente');
    Route::post('/recherche', 'GoodController@traiterRechercheObjet');

    Route::get('/objet/{id}', 'GoodController@afficherObjet');
    Route::get('/objet/{id}/enchere', 'GoodController@afficherFormulaireFaireEnchere');
    Route::post('/objet/{id}/enchere', 'GoodController@traiterFormulaireFaireEnchere');

    Route::get('/ventes_en_cours', 'GoodController@afficherVentesEnCours');
});

Route::get("test", function () {
    $prix = 125.25;
    $prices = explode(".", $prix);
    $length = strlen($prices[0]);
    $multiplicateur = str_pad("1", $length-1, "0", STR_PAD_RIGHT);
    $step = intval($multiplicateur);

    $enchere_min = $prix + $step;
    var_dump($step);
    var_dump($enchere_min);
});