<?php

namespace App\Fleet;

use Illuminate\Database\Eloquent\Model;

class FuelRequisition extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function vehicle()
    {
        return $this->belongsTo('App\Fleet\Vehicle');
    }
}
