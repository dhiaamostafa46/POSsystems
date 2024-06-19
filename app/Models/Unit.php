<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Unit extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'units';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAr','nameEn','quantity'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product','unitID');
    }
    public function compUnit()
    {
        return $this->hasOne('App\Models\ProdUnit','unitID');
    }

}
