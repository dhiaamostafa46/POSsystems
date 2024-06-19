<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Purchase extends Authenticatable
{
    use HasFactory, Notifiable;


    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','supplierID','type','status','totalwvat','totalvat','NameAcount','AccountID','AccountPurch'
    ];


    public function purchasedetails()
    {
        return $this->hasMany('App\Models\Purchasedetails','purchaseID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplierID');
    }

    public function deliver()
    {
        return $this->hasMany('App\Models\Invoice','purchaseID');
    }

}
