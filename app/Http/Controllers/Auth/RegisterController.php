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
use Illuminate\Support\Facades\Validator;
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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            // Ajout de la création d'un token unique pour la verification de l'inscription par email
            'inscription_token' => str_random(128)
        ]);

    }

    /**
     * @param Request $request
     */
    public function register(Request $request)
    {
        // on valide le formulaire
        $this->validator($request->all())->validate();

        // on créé un utilisateur
        $user = $this->create($request->all());

        // on envoie un email de confirmation d'inscription
        Mail::to($user->email)->send(new EmailConfirmationInscription($user));

        // si l'envoie du mail a échoué
        if (Mail::failures()) {
            // on supprime l'utilisateur de la bdd pour annuler l'inscription
            $user->delete();
            // on envoie un message d'erreur
            Session::flash("notification", [
                "status" => "error",
                "message" => "Une erreur est survenue lors de l'inscription, veuillez réessayer."
            ]);
            return redirect("/register");
        } else {
            // si l'email est bien parti
            event(new Registered($user));
            // on redirige l'utilisateur vers la page de login avec un message
            Session::flash("notification", [
                "status" => "success",
                "message" => "Pour finaliser votre inscription, confirmer votre inscription depuis l'email envoyé à $user->email"
            ]);
            return redirect("/login");
        }


    }

    /**
     * @param $inscriptionToken
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmationInscription($inscriptionToken, Request $request)
    {
        $user = User::where('inscription_token', $inscriptionToken)->first();
        if (!empty($user) && $user->inscription_confirme == false) {
            $user->inscription_token = null;
            $user->inscription_confirmee = true;
            $user->save();
            Auth::login($user);

            Session::flash("notification", array(
                "status" => "success",
                "message" => "Votre compte est désormais validé, vous pouvez profiter pleinement du site."
            ));
            return redirect()->to("/home");
        } else {
            abort(404);
        }
    }
}
