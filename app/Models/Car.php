<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Car extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'cars';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assetID','modelNo','bodyNo','blatNo','licence','insurance','licenceExpDate','insuranceExpDate','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID')->where('Status',1);
    }
    public function type()
    {
        return $this->belongsTo('App\Models\AssetType','typeID');
    }

}
