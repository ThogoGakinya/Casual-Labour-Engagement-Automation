<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Staff\Requisition;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function requisitions()
    {
        return $this->hasMany('App\Staff\Requisition');
    }
    public function voucherbooks()
    {
        return $this->hasMany('App\Staff\Voucherbook');
    }
    public function documents()
    {
        return $this->hasMany('App\Staff\Document');
    }
    public function category_history()
    {
        return $this->hasMany('App\Staff\Category_history');
    }
    public function department()
    {
        return $this->hasMany('App\Staff\Department');
    }
    public function categories()
    {
        return $this->hasMany('App\Staff\Category');
    }
    public function burferfloat()
    {
        return $this->hasMany('App\Staff\Burferfloat');
    }
    public function vehicles()
    {
        return $this->hasMany('App\Fleet\Vehicle');
    }
    public function vehicle()
    {
        return $this->belongsTo('App\Fleet\Vehicle');
    }
    public function placement()
    {
        return $this->hasMany('App\Fleet\FuelRequisition');
    }
    public function dailycasual()
    {
        return $this->belongsTo('App\DCE\Dailycasuals');
    }
    public function dailycasualapprovals()
    {
        return $this->belongsTo('App\DCE\DCEApprovals');
    }
   
    
   
}
