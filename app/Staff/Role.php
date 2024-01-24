<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permission()
    {
        return $this->hasMany('App\Staff\Permission');
    }
    public function voter()
    {
        return $this->hasMany('App\Staff\Voter');
    }
}
