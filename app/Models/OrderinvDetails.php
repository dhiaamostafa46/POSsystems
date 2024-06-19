<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderinvDetails extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'orderinv_details';
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
        return $this->belongsTo('App\Models\OrderInv','orderID');
    }
}
