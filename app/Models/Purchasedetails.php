<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Purchasedetails extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'purchasedetails';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','productID','price','quantity' ,'item_name','unitProdecid'
    ];

    public function purchase()
    {
        return $this->hasMany('App\Models\Purchase','purchaseID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','productID');
    }

    public function ProdUnit()
    {
        return $this->belongsTo('App\Models\ProdUnit','unitProdecid');
    }

}
