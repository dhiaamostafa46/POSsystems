<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrgSub extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'orgsubs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','subID','Status'
    ];

    public function subs()
    {
        return $this->belongsTo('App\Models\Subs','subID')->where('status',1);
    }

}
