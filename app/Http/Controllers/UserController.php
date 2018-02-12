<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormulaireRechargerCreditsPost;
use App\Mail\EmailRechargeCredits;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function afficherMesVentesEnCours()
    {
        $data = array(
            "goods" => Auth::user()->biensEnVente()->orderBy("date_fin", "desc")->get()
        );
        return view("user.mesVenteEnCours", $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function afficherMesVentesTerminees()
    {
        $data = array(
            "goods" => Auth::user()->biensVendus()->orderBy("date_fin", "desc")->get()
        );
        return view("user.mesVentesTerminees", $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function afficherMesAchats()
    {
        $data = array(
            "goods" => Auth::user()->biensAchetes()->orderBy("date_fin", "desc")->get()
        );
        return view("user.mesAchats", $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function afficherMesEncheresEnCours()
    {
        $data = array(
            "encheres" => Auth::user()->encheresEnCours()->orderBy("date_fin", "desc")->get()
        );
        return view("user.mesEncheresEnCours", $data);
    }


    public function afficherMonProfil()
    {
        $data = array(
            "user" => Auth::user()
        );
        return view('user.monProfil', $data);
    }

    public function afficherProfil($username)
    {
        if (Auth::user()->username == $username) {
            return redirect()->to("/mon_profil");
        }

        $user = User::where("username", $username)->first();

        if (empty($user)) {
            abort(404);
        }

        $data = array(
            "user" => $user
        );
        return view('profil', $data);
    }

    public function afficherFormulaireRechargerCredits()
    {
        return view('formulaireRechargerCredits');
    }

    public function traiterFormulaireRechargerCredits(FormulaireRechargerCreditsPost $request)
    {
        $auth_user = Auth::user();
        $auth_user->credits += $request->credits;
        
        if (!$auth_user->save()) {
            // Si une erreur est survenue on recharge le formulaire avec un message d'erreur
            $data = array(
                "form_error" => "Une erreur lors du paiement est survenue !"
            );
            return view("formulaireRechargerCredits", $data);
        } else {
            Mail::to($auth_user->email)->send(new EmailRechargeCredits($auth_user, $request->credits));
            // On recharge la page avec un message de succès
            $data = array(
                "form_succes" => "Merci pour votre commande, vos nouveaux crédits ont été ajoutés à votre compte.",
            );
            return view("formulaireRechargerCredits", $data);
        }
    }
}
