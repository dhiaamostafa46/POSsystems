<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Supplierpayment extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'supplierpayments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','purchaseID','invoiceID','supplierID','type','status','debit','cred'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplierID');
    }

}
