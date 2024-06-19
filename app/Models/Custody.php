<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Custody extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'custodies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    
    protected $fillable = [
        'orgID','empID','typeID','assetID','quantity','details','file','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID')->where('Status',1);
    }
    public function doctype()
    {
        return $this->belongsTo('App\Models\DocType','typeID');
    }
    public function asset()
    {
        return $this->belongsTo('App\Models\Asset','assetID');
    }

}
