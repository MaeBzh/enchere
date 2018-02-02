<?php

namespace App\Http\Controllers;

use App\Enchere;
use App\Good;
use App\Http\Requests\FormulaireMiseEnVentePost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GoodController extends Controller
{
    public function afficherFormulaireMiseEnVente()
    {
        return view("formulaireMiseEnVente");
    }

    public function afficherObjet($id)
    {
        $data = array(
            "objet" => Good::find($id)
        );
        return view("detailObjet", $data);
    }

    /**
     * Traitement des informations envoyées depuis le formulaire
     * On rentre dans la fonction uniquement si les data du formulaire ont été validées (cf : app/Requests/FormulaireMiseEnVentePost::rules)
     *
     * @param FormulaireMiseEnVentePost $request
     */
    public function traiterFormulaireMiseEnVente(FormulaireMiseEnVentePost $request)
    {
        $good = new Good();
        $good->titre = $request->titre;
        $good->description = $request->description;
        $good->prix_depart = $request->prix_depart;
        $good->date_debut = Carbon::now();
        $good->date_fin = Carbon::now()->addDays(Enchere::DUREE_ENCHERE_JOURS);
        $good->vendeur_id = Auth::user()->id;

        // Si un image valide a été envoyée depuis le formulaire, on enregistre l'image et on stock le chemin dans l'objet
        if ($request->hasFile("photo") && $request->file("photo")->isValid()) {
            $chemin = Storage::disk("public")->put("photos", $request->file("photo"));
            // On s'assure que le fichier a bien été enregistré dans l'espace de stockage
            if (Storage::exists($chemin)) {
                $good->photo = $chemin;
            }
        }

        if(!$good->save()) {
            // Si une erreure est survenue on recharge le formulaire avec un message d'erreur
            $data = array(
              "form_error" => "Une erreur lors de l'enregistrement est survenue !"
            );
            return view("formulaireMiseEnVente", $data);
        } else {
            // On recharge la page avec un message de succès
            $data = array(
                "form_succes" => "Votre objet a bien été mis en vente.",
                "good_url" => "objet/$good->id"
            );
            return view( "formulaireMiseEnvente", $data);
        }
    }

    public function traiterRechercheObjet(Request $request)
    {
        $data = array(
            'recherche' => Good::where('titre', 'LIKE', '%' . $request->recherche . '%')->get()
        );
        return view('rechercheObjets', $data);
    }
}
