<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Temporder extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'temporders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','customerID','type','status','totalwvat','totalvat','tblNo'
    ];

    public function orderdetails()
    {
        return $this->hasMany('App\Models\Temporderdetails','orderID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customerID');
    }

    public function VirtualCustomer()
    {
        return $this->belongsTo('App\Models\VirtualCustomer','customerID');
    }


    public function table()
    {
        return $this->belongsTo('App\Models\Tbl','tblNo');
    }
    public function receive()
    {
        return $this->hasMany('App\Models\Invoice','orderID');
    }


    public function Organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }


}
