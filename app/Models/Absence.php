<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Absence extends Authenticatable
{
    

    use HasFactory, Notifiable;
    protected $table = 'absencesrequests';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'absDate' => 'datetime'
    ];

    protected $fillable = [
        'orgID','empID','from','to','hours','details','absDate','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\NoticType','typeID');
    }
    public function details()
    {
        return $this->hasMany('App\Models\NoticDetails','noticID');
    }

}
