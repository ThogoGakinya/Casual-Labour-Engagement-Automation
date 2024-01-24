<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HiredCasuals extends Model
{
    public function user()
    {
        return $this->belongsTo('App\DCE\Casual');
    }
}
