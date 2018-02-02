<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enchere extends Model
{
    const DUREE_ENCHERE_JOURS = 7;

    protected $table = 'encheres';
    public $timestamps = false;

    protected $dates = [
      "date_enchere"
    ];

    public function acheteur()
    {
        return $this->belongsTo(User::class, "acheteur_id");
    }

    public function bien()
    {
        return $this->belongsTo(Good::class, "good_id");
    }
}
