<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProdUnit extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'produnits';
    /**
     * The attributes that are mass assignable.
     *
     *
     * @var array
     */
    protected $fillable = [
        'prodID','unitID','quantity','price','sales','purchase','report','compon' ,'count','costprodect','saller','countSaller'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product','unitID');
    }


    public function Unit()
    {
        return $this->belongsTo('App\Models\Unit','unitID');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','prodID');
    }

    public function DepotStore()
    {
        return $this->belongsTo('App\Models\DepotStore','StoreId');
    }

}
