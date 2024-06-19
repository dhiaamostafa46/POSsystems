<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Stockinoutdetails extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'stockinoutdetails';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','productID','quantity'
    ];

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
