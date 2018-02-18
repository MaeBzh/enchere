<?php

namespace App;

use App\Mail\EmailResetPassword;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Good[] $biensAchetes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Good[] $biensEnVente
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Good[] $biensVendus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Enchere[] $encheresEnCours
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Enchere[] $encheresVentesTerminees
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $inscription_token
 * @property int $inscription_confirmee
 * @property int $credits
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInscriptionConfirmee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInscriptionToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prenom', 'username', 'email', 'password', 'inscription_token', 'inscription_confirmee', 'credits'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';
    public $timestamps = false;

    public function sendPasswordResetNotification ($token){
        Mail::to($this->email)->send(new EmailResetPassword($token));
    }

    public function biensAchetes()
    {
        return $this->hasMany(Good::class, 'acheteur_id')->where("date_fin", '<=', Carbon::now());
    }

    /*public function ventesEnCours()
    {
        return $this->hasMany(Good::class, 'acheteur_id')->where("date_fin", '>', Carbon::now());
    }*/

    public function biensVendus()
    {
        return $this->hasMany(Good::class, 'vendeur_id')->where("date_fin", '<=', Carbon::now());
    }

    public function biensEnVente()
    {
        return $this->hasMany(Good::class, 'vendeur_id')->where("date_fin", '>', Carbon::now());
    }

    public function encheresVentesTerminees()
    {
        return $this->hasMany(Enchere::class, 'acheteur_id')->join("goods", "goods.id", '=', "encheres.good_id")->Where("date_fin", '<=', Carbon::now());
    }

    public function encheresEnCours()
    {
        return $this->hasMany(Enchere::class, 'acheteur_id')->join("goods", "goods.id", '=', "encheres.good_id")->Where("date_fin", '>', Carbon::now());
    }

    public function hasEnoughCredits()
    {
        return $this->credits >= config("config.credits.vendre_objet", 1);
    }
}
