<?php

namespace App\DCE;

use Illuminate\Database\Eloquent\Model;

class Casual extends Model
{
    public function hiredcasual()
    {
        return $this->hasMany('App\HiredCasuals');
    }
}
