<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Voucherbook extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
