<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrgSetting extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'orgsettings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','storecolor'
    ];

    public function employees()
    {
        return $this->hasMany('App\Models\Product','categoryID')->where('status',1);
    }


    public function Empallowan()
    {
        return $this->hasMany('App\Models\Empallowan','allowID')->where('status',1);
    }

}
