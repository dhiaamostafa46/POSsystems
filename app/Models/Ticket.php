<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Ticket extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'tickets';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','userID','teamID','details','tickStatus','teamComment','solveDate'.'Status'
    ];

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

}
