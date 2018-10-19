<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conpte extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function operations()
    {
        return $this->hasMany('App\Operation');
    }
}
