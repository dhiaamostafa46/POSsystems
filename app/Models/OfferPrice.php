<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OfferPrice extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'offerprice';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','customerID','type','status','totalwvat','totalvat','NameAcount','AccountID','salaseAccount',"kind"
    ];


    public function OfferPricedetails()
    {
        return $this->hasMany('App\Models\OfferPricedetails','orderID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function VirtualCustomer()
    {
        return $this->belongsTo('App\Models\VirtualCustomer','customerID');
    }

    public function Customer()
    {
        return $this->belongsTo('App\Models\Customer','customerID');
    }

    public function receive()
    {
        return $this->hasMany('App\Models\Invoice','orderID');
    }
}
