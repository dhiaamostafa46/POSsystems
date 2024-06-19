<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TickHistory extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'tiketsHistory';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tickID','comment','image','owner','ownerID','created_at'
    ];

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\OrgUser','userID');
    }
     public function team()
    {
            return $this->belongsTo('App\Models\User','teamID');
    }

}
