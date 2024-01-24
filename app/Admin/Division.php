<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function department()
    {
        return $this->belongsTo('App\Staff\Department');
    }
    public function line_manager()
    {
        return $this->belongsTo('App\User');
    }
    public function dailycasuals()
    {
        return $this->hasMany('App\DCE\Dailycasuals');
    }
}
