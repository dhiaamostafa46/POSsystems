<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Invoice extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'invoices';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','customerID','supplierID','type','status','total','AccountID','nameAccount','date','CostCenter'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customerID');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplierID');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order','orderID');
    }

    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase','purchaseID');
    }

}
