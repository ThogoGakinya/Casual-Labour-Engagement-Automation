<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Category_history extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
