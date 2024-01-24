<?php

namespace App\DCE;

use Illuminate\Database\Eloquent\Model;

class DCEApprovals extends Model
{
    public function hod()
    {
        return $this->belongsTo('App\User');
    }
    public function budgetofficer()
    {
        return $this->belongsTo('App\User');
    }
    public function hr()
    {
        return $this->belongsTo('App\User');
    }
    public function wages()
    {
        return $this->belongsTo('App\User');
    }
}
