<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function requisition()
    {
        return $this->hasMany('App\Staff\Requisition');
    }
    public function hod()
    {
        return $this->belongsTo('App\User');
    }
    public function division()
    {
        return $this->hasMany('App\Admin\Division');
    }
    public function dailycasuals()
    {
        return $this->hasMany('App\DCE\Dailycasuals');
    }
}
