<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    public function reward()
    {
        return $this->belongsTo('App\Staff\Reward');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Staff\Voter');
    }
}
