<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SubsPayment extends Authenticatable
{
   
    

    use HasFactory, Notifiable;
    protected $table = 'subspayments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    

    protected $fillable = [
        'orgID','userID','orderNo','amount','paymentMethod','details','Status'
    ];

    public function orgnization()
    {
        return $this->belongsTo('App\Models\Organization','orgID')->where('Status',1);
    }
    public function type()
    {
        return $this->belongsTo('App\Models\AssetType','typeID');
    }
    public function car()
    {
        return $this->belongsTo('App\Models\Car','carID');
    }
    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

}
