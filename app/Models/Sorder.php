<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Sorder extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'sorders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','type','status',
    ];

    public function sorderdetails()
    {
        return $this->hasMany('App\Models\Sorderdetails','sorderID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase','purchaseID');
    }

    public function approve()
    {
        return $this->belongsTo('App\Models\User','approveID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }



}
