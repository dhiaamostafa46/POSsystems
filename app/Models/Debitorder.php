<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Debitorder extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'debitorders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','customerID','type','status','totalwvat','totalvat','nameAccount','AccountID'
    ];

    public function orderdetails()
    {
        return $this->hasMany('App\Models\Debitorderdetails','orderID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function Supplier()
    {
        return $this->belongsTo('App\Models\Supplier','customerID');
    }

}
