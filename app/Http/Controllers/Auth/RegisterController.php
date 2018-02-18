<?php

namespace App\Http\Controllers\Auth;

use App\Mail\EmailConfirmationInscription;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use \App\Http\Requests\RegisterPost;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Où rediriger les utilisateurs après l'inscription.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * On autorise l'accès au controller pour les visiteurs non connectés
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Traitement du formulaire d'inscription
     * 
     * @param Request $request
     */
    public function register(RegisterPost $request)
    {
        // on recupère tous les champs
        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->inscription_token = str_random(128);
        
        // si l'insertion en bdd échoue
        if(!$user->save()){
            Session::flash("notification", [
                "status" => "error",
                "message" => "Une erreur est survenue lors de l'inscription, veuillez réessayer."
            ]);
            // on redirige vers le formulaire d'inscription
            return redirect("/register");
        }
        
        // on envoie un email de confirmation d'inscription
        Mail::to($user->email)->send(new EmailConfirmationInscription($user));

        // si l'envoi du mail a échoué
        if (Mail::failures()) {
            // on supprime l'utilisateur de la bdd pour annuler l'inscription
            $user->delete();
            // on envoie un message d'erreur
            Session::flash("notification", [
                "status" => "error",
                "message" => "Une erreur est survenue lors de l'inscription, veuillez réessayer."
            ]);
            // on redirige vers le formulaire d'inscription
            return redirect("/register");
        } else {
            // si l'email est bien parti
            event(new Registered($user));
            // on redirige l'utilisateur vers la page de login avec un message
            Session::flash("notification", [
                "status" => "success",
                "message" => "Pour finaliser votre inscription, confirmer votre inscription depuis l'email envoyé à $user->email"
            ]);
            // on redirige vers le formulaire de connexion
            return redirect("/login");
        }
    }

    /**
     * L'utilisateur a cliqué sur le lien de validation d'inscription dans son email
     * 
     * @param $inscriptionToken
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmationInscription($inscriptionToken, Request $request)
    {
        // on récupère l'utilisateur qui correspond au token du mail
        $user = User::where('inscription_token', $inscriptionToken)->first();
        
        // si on a bien un enregistrement en bdd qui correspond et qui n'est pas déjà confirmé
        if (!empty($user) && $user->inscription_confirme == false) {
            // on supprime le token
            $user->inscription_token = null;
            // on valide l'inscription
            $user->inscription_confirmee = true;
            // on sauvegarde les modifications
            $user->save();
            
            // On authentifie directement l'utilisateur
            Auth::login($user);

            Session::flash("notification", array(
                "status" => "success",
                "message" => "Votre compte est désormais validé, vous pouvez profiter pleinement du site."
            ));
            // on redirige l'utilisateur
            return redirect()->to("/home");
        } else {
            // on renvoie une erreur 404 not found
            abort(404);
        }
    }
}
