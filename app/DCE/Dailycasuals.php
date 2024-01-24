<?php

namespace App\DCE;

use Illuminate\Database\Eloquent\Model;

class Dailycasuals extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function hod()
    {
        return $this->belongsTo('App\User');
    }
    
    public function manager()
    {
        return $this->belongsTo('App\User');
    }
    public function dept()
    {
        return $this->belongsTo('App\Staff\Department');
    }
    public function div()
    {
        return $this->belongsTo('App\Admin\Division');
    }
    
    protected $dates = ['created_at'];
}
