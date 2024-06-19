<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Respons extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'responses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_','response_','orgID','userID'
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
