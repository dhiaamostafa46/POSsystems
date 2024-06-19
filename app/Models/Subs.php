<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Subs extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'subs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','nameAr','nameEn','Status'
    ];

    public function employees()
    {
        return $this->hasMany('App\Models\Product','categoryID')->where('status',1);
    }

}
