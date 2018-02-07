<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $table = 'goods';
    public $timestamps = false;

    protected $dates = [
        "date_debut",
        "date_fin"
    ];

    public function acheteur()
    {
        return $this->belongsTo(User::class);
    }

    public function vendeur()
    {
        return $this->belongsTo(User::class);
    }

    public function encheres()
    {
        return $this->hasMany(Enchere::class, "good_id");
    }


    public function getPrix()
    {
        if (!empty($this->prix_final)) {
            return $this->prix_final;
        } elseif ($this->encheres()->exists()) {
            return $this->encheres()->orderBy("id", "desc")->first()->montant;
        } else {
            return $this->prix_depart;
        }
    }

    public function getUrlPhoto()
    {
        if (!empty($this->photo)) {
            return asset("storage/$this->photo");
        } else {
            return asset("img_empty.png");
        }
    }

    public function isTermine()
    {
        return $this->date_fin <= Carbon::now();
    }

    public function getTempsRestant()
    {
        if (!$this->isTermine()) {
            $difference = $this->date_fin->diff(Carbon::now());

            $temps_restant = "";
            if (($days = $difference->d) > 0) {
                $temps_restant .= "{$days}j";
            }
            if (($hours = $difference->h) > 0) {
                $temps_restant .= " {$hours}h";
            }
            if (($minutes = $difference->i) > 0) {
                $temps_restant .= " {$minutes}m";
            }
            if (($seconds = $difference->s) > 0) {
                $temps_restant .= " {$seconds}s";
            }

            return trim($temps_restant, " ");
        }

        return null;
    }

    public function isVendu()
    {
        return $this->encheres() - exists();
    }
}
