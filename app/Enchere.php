<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enchere extends Model
{
    protected $table = 'encheres';
    public $timestamps = false;

    public function acheteur()
    {
        return $this->belongsTo(User::class, "acheteur_id");
    }

    public function bien()
    {
        return $this->belongsTo(Good::class, "good_id");
    }
}
