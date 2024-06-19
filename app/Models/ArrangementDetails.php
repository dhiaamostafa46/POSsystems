<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArrangementDetails extends Model
{
    protected $table = 'arrangement_details';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'productID','quantity','nameprodect','priceprodect','idConvert'
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
}
