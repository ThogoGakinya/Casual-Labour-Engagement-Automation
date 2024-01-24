<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function nominated()
    {
        return $this->belongsTo('App\Staff\Voter');
    }
    public function user()
    {
        return $this->belongsTo('App\Staff\Voter');
    }
    public function reward()
    {
        return $this->belongsTo('App\Staff\Reward');
    }
    
}
