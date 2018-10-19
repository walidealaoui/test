<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    //

    const valid_status='valide';
    const encours_status='encours';
    const annule_status='annule';
    public function conpte()
    {
        return $this->belongsTo('App\Conpte');
    }
}
