<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Stockinout extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'stockinout';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','type','status','depotID'
    ];

    public function stockinoutdetails()
    {
        return $this->hasMany('App\Models\Stockinoutdetails','stockinoutID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function DepotStore()
    {
        return $this->belongsTo('App\Models\DepotStore','depotID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }



}
