<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enchere extends Model
{
    protected $table = 'encheres';
    public $timestamps = false ;

    public function acheteur()
    {
        return $this->belongsTo('App\User');
    }
}
