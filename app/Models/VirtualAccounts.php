<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class VirtualAccounts extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'virtual_accounts';

    protected $fillable = [
        'bank','treasury','sale','returnsale','purch','returnpuch','costcenter','orgID','userID'
    ];



 


}
