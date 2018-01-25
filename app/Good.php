<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $table = 'goods';
    public $timestamps = false ;

    public function acheteur()
    {
        return $this->belongsTo('App\User');
    }

    public function vendeur()
    {
        return $this->belongsTo('App\User');
    }
}
