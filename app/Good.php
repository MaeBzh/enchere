<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $table = 'goods';
    public $timestamps = false;

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
}
