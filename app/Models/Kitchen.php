<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kitchen extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'kitchens';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAr','nameEn'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order','tblID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

}
