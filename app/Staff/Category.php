<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function cashbooks()
    {
        return $this->hasMany('App\Staff\Cashbook');
    }
    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}
