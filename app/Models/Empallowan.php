<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Empallowan extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'empallowances';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empID','allowID','value','Status'
    ];

    public function employees()
    {
        return $this->hasMany('App\Models\Product','categoryID')->where('status',1);
    }
    public function allow()
    {
        return $this->belongsTo('App\Models\Allowan','allowID');
    }

}
