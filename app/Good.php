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
            return $this->encheres()->orderBy("date_enchere", "desc")->first()->montant;
        } else {
            return $this->prix_depart;
        }
    }

    public function isTermine(){
        return $this->date_fin <= Carbon::now();
    }

    public function isVendu(){
        return $this->encheres()-exists();
    }
}
