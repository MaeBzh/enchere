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

Route::resource('user', 'UserController');
Route::resource('good', 'GoodController');
Route::resource('enchere', 'EnchereController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profil', 'ProfilController@afficherProfil');
Route::get('/ventesEnCours', 'UserController@afficherVentesEnCours');
Route::get('/ventesTerminees', 'UserController@afficherVentesTerminees');
Route::get('/achats', 'UserController@afficherAchats');
Route::get('/encheresEnCours', 'UserController@afficherEncheresEnCours');
Route::get('/formulaireMiseEnVente', 'GoodController@afficherFormulaireMiseEnVente');
Route::post('/formulaireMiseEnVente', 'GoodController@traiterFormulaireMiseEnVente');
Route::post('/rechercheObjet', 'GoodController@traiterRechercheObjet');
Route::get('/objet/{id}', 'GoodController@afficherObjet');



Route::get('test', function (){
    $user = \Illuminate\Support\Facades\Auth::user();
    $bien = \App\Good::find(4);
    $encheres = $user->encheres()->where("good_id", $bien->id)->limit(5)->orderBy("date_enchere", "desc")->get();
    dd($encheres);
});
