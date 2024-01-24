<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Valuevote extends Model
{
    public function corevalue()
    {
        return $this->belongsTo('App\Staff\Corevalue');
    }
    public function nominated()
    {
        return $this->belongsTo('App\Staff\Voter');
    }
    public function voter()
    {
        return $this->belongsTo('App\Staff\Voter');
    }
}
