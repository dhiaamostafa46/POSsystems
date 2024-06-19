<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Drivethru extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'drivethrus';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qrNo'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order','drivethruID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

}
