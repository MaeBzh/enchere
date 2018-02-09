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

Route::get('/home', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->to("/ventes_en_cours");
    } else {
        return redirect()->to("/");
    }
});

Auth::routes();
Route::get('/confirmerInscription/{inscriptionToken}', 'Auth\RegisterController@confirmationInscription')->name("confirmation_inscription");

// Toutes les routes faisant partie de se groupe sont innaccessibles pour un visiteur non authentifié
Route::middleware("auth")->group(function () {

    Route::get('/mon_profil', 'UserController@afficherMonProfil')->name("user.profil");
    Route::get('/mes_ventes_en_cours', 'UserController@afficherMesVentesEnCours')->name("user.ventes_en_cours");
    Route::get('/mes_ventes_terminees', 'UserController@afficherMesVentesTerminees')->name("user.ventes_terminees");
    Route::get('/mes_achats', 'UserController@afficherMesAchats')->name("user.achats");
    Route::get('/mes_encheres_en_cours', 'UserController@afficherMesEncheresEnCours')->name("user.encheres_en_cours");

    Route::get('/profil/{username}', 'UserController@afficherProfil')->name("all.profil");

    Route::get('/mettre_en_vente', 'GoodController@afficherFormulaireMiseEnVente')->name("form.mettre_en_vente.get");
    Route::post('/mettre_en_vente', 'GoodController@traiterFormulaireMiseEnVente')->name("form.mettre_en_vente.post");
    Route::post('/recherche', 'GoodController@traiterRechercheObjet')->name("form.recherche.post");

    Route::get('/objet/{id}', 'GoodController@afficherObjet')->name("objet.detail");
    Route::get('/objet/{id}/enchere', 'GoodController@afficherFormulaireFaireEnchere')->name("form.faire_enchere.get");
    Route::post('/objet/{id}/enchere', 'GoodController@traiterFormulaireFaireEnchere')->name("form.faire_enchere.post");

    Route::get('/ventes_en_cours', 'GoodController@afficherVentesEnCours')->name("all.ventes_en_cours");
});