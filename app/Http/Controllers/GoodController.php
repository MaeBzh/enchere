<?php

namespace App\Http\Controllers;

use App\Good;
use App\Http\Requests\FormulaireMiseEnVentePost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class GoodController extends Controller
{
    public function afficherFormulaireMiseEnVente(){
        return view("formulaireMiseEnVente");
    }

    /**
     * Traitement des informations envoyées depuis le formulaire
     * On rentre dans la fonction uniquement si les data du formulaire ont été validées (cf : app/Requests/FormulaireMiseEnVentePost::rules)
     *
     * @param FormulaireMiseEnVentePost $request
     */
    public function traiterFormulaireMiseEnVente(FormulaireMiseEnVentePost $request){
        $good = new Good();
        $good->titre = $request->titre;
        $good->description = $request->description;
        $good->prix_depart = $request->prix_depart;
        $good->date_debut = Carbon::now();
        $good->date_fin = Carbon::now()->addDays(7);
        $good->vendeur_id = Auth::user()->id;
        $good->save();
    }

    public function rechercheObjet(){

    }

}
