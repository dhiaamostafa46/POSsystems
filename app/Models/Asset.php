<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Asset extends Authenticatable
{
   
    

    use HasFactory, Notifiable;
    protected $table = 'asstets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','carID','empID','typeID','branchID','nameAr','nameEn','details','assetStatus','addBy','isTaked','isCar','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID')->where('Status',1);
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
