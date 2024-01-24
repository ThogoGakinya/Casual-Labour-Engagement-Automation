<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function reward()
    {
        return $this->belongsTo('App\Staff\Reward');
    }
    public function role()
    {
        return $this->belongsTo('App\Staff\Role');
    }
}
