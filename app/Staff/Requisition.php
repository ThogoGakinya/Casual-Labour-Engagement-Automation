<?php

namespace App\Staff;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function hod()
    {
        return $this->belongsTo('App\User');
    }
    public function budgeto()
    {
        return $this->belongsTo('App\User');
    }
    public function hod_approver()
    {
        return $this->belongsTo('App\User');
    }
    public function budget_approver()
    {
        return $this->belongsTo('App\User');
    }
    public function admin_approver()
    {
        return $this->belongsTo('App\User');
    }
    public function budgeto_approver()
    {
        return $this->belongsTo('App\User');
    }
    public function documents_approver()
    {
        return $this->belongsTo('App\User');
    }
    public function decline()
    {
        return $this->belongsTo('App\User');
    }
    public function cfo_approver()
    {
        return $this->belongsTo('App\User');
    }
    public function ia_approver()
    {
        return $this->belongsTo('App\User');
    }
    public function voucher()
    {
        return $this->belongsTo('App\Staff\Category');
    }
    public function department()
    {
        return $this->belongsTo('App\Staff\Department');
    }
}
