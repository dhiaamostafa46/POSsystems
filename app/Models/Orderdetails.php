<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Orderdetails extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'orderdetails';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','productID','price','quantity','nadel'
    ];

    public function orderdetails()
    {
        return $this->hasMany('App\Models\Orderdetails','orderID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','productID');
    }

    public function Order()
    {
        return $this->belongsTo('App\Models\Order','orderID');
    }
    
    public function extrasdetials()
    {
        return $this->hasMany('App\Models\extrasdetials','IDorder');
    }

}
