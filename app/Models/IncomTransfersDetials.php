<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomTransfersDetials extends Model
{
    protected $table = 'incom_transfers_detials';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'productID','quantity','nameprodect','priceprodect','idConvert','uniteid'
    ];


    ///
    public function stockinout()
    {
        return $this->hasMany('App\Models\Stockinout','stockinoutID');
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
        return $this->belongsTo('App\Models\ProdUnit','uniteid');
    }
}
