<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Cashbook extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Staff\Category');
    }
}
