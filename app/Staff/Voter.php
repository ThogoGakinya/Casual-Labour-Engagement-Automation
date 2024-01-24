<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
   public function nominee_1()
    {
        return $this->hasMany('App\Staff\Valuevote');
    }
    public function valuevote()
    {
        return $this->hasMany('App\Staff\Valuevote');
    }
    public function vote()
    {
        return $this->hasMany('App\Staff\Vote');
    }
    public function nominee()
    {
        return $this->hasMany('App\Staff\Nominee');
    }
    public function role()
    {
        return $this->belongsTo('App\Staff\Role');
    }
}
