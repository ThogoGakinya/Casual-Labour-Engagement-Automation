<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    public function nominee()
    {
        return $this->hasMany('App\Staff\Nominee');
    }
     public function permission()
    {
        return $this->hasMany('App\Staff\Permission');
    }
     public function criteria()
    {
        return $this->hasMany('App\Staff\Criteria');
    }
     public function vote()
    {
        return $this->hasMany('App\Staff\Vote');
    }
}
