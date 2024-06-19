<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customerpayment extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'customerpayments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','purchaseID','invoiceID','customerID','type','status','debit','cred'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customerID');
    }

}
