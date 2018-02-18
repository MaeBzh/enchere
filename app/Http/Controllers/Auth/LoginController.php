<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Où rediriger les utilisateurs après la connexion.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * On autorise l'acces au controller pour les visiteurs non connectés
     * ou pour les utilisateurs connecté si ils se deconnectent
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Definie le champs qui sert de login en bdd
     * @return string
     */
    public function username()
    {
        return 'username';
    }
    
    /**
     * Initialise les informations d'identification.
     * 
     * @param Request $request
     * @return array
     */
    public function credentials(Request $request)
    {
        return [
            'username' => $request->username,
            'password' => $request->password,
            'inscription_confirmee' => true,
        ];
    }
}
