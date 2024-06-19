<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StoreConversion extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'store_conversions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchOne','branchTow','userID','type','comment','status','items'
    ];



    public function StoreConversiondetails() {
        return $this->hasMany('App\Models\StoreConversiondetails','idConvert');
    }
    public function DepotStoreOne()
    {
        return $this->belongsTo('App\Models\DepotStore','branchOne');
    }
    public function DepotStoretow()
    {
        return $this->belongsTo('App\Models\DepotStore','branchTow');
    }









    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }


    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function stockinout()
    {
        return $this->hasMany('App\Models\Stockinout','stockinoutID');
    }


}
