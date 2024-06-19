<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'customers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','area','city','district','addressAr','addressEn','vatNo','phone','email','status','orgID','branchID','userID'
    ];

    public function payments()
    {
        return $this->hasMany('App\Models\Customerpayment','customerID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'));
    }

    public function postpaid()
    {
        return $this->hasMany('App\Models\Order','customerID')->where('type',3);
    }

}
