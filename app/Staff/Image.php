<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
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
