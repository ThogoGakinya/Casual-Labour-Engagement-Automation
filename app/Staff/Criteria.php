<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    public function reward()
    {
        return $this->belongsTo('App\Staff\Reward');
    }
}
