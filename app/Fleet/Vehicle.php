<?php

namespace App\Fleet;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function driver()
    {
        return $this->belongsTo('App\User');
    }

    public function vehicle()
    {
        return $this->hasMany('App\User');
    }

    public function placement()
    {
        return $this->hasMany('App\Fleet\FuelRequisition');
    }
}
