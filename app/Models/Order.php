<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Order extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','customerID','type','status','totalwvat','totalvat','NameAcount','AccountID','salaseAccount',"kind"
    ];


    public function orderdetails()
    {
        return $this->hasMany('App\Models\Orderdetails','orderID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function Customer()
    {
        return $this->belongsTo('App\Models\Customer','customerID');
    }
    public function vCustomer()
    {
        return $this->belongsTo('App\Models\VirtualCustomer','customerID');
    }

    public function receive()
    {
        return $this->hasMany('App\Models\Invoice','orderID');
    }
    public function table()
    {
        return $this->belongsTo('App\Models\Tbl','tblNo');
    }


}
