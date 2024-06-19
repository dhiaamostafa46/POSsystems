<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Stock extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'stockitems';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productID','quantityIn','quantityOut','status','depotID'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Product','productID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','productID');
    }
    
    
       public function DepotStore()
    {
        return $this->belongsTo('App\Models\DepotStore','depotID');
    }

}
