<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Supplier extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'suppliers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','area','city','district','address','vatNo','phone','email','status','orgID','branchID','userID'
    ];

    public function payments()
    {
        return $this->hasMany('App\Models\Supplierpayment','supplierID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'));
    }

    public function postpaid()
    {
        return $this->hasMany('App\Models\Purchase','supplierID')->where('type',3);
    }

}
