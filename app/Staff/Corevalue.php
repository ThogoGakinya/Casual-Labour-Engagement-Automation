<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Corevalue extends Model
{
   public function corevalue()
    {
        return $this->hasMany('App\Staff\Valuevote');
    }
}
