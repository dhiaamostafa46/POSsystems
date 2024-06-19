<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Duration extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'durations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'durationNo'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order','durationID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function endby()
    {
        return $this->belongsTo('App\Models\User','endBy');
    }

}
