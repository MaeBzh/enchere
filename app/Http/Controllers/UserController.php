<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function afficherVentesEnCours(){
        $data = array(
            "biens" => Auth::user()->biensEnVente()->orderBy("date_fin", "desc")->get()
        );
        return view("venteEnCours", $data);
    }
    public function  afficherVentesTerminees(){
        $data = array(
            "biens" => Auth::user()->biensVendus()->orderBy("date_fin", "desc")->get()
        );
        return view("ventesTerminees", $data);
    }

    public function afficherAchats(){
        $data = array(
            "achats" => Auth::user()->biensAchetes()->orderBy("date_fin", "desc")->get()
        );
        return view("achats", $data);
    }
    public function afficherEncheresEnCours(){
        $data = array(
            "encheres" => Auth::user()->encheresEnCours()->orderBy("date_fin", "desc")->get()
        );
        return view("encheresEnCours", $data);
    }
}
