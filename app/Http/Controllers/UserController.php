<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()->username == $username){
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
}
