<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoutAccount extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'rout_accounts';

    protected $fillable = [
        'Customers','Suppliers','Store','Bank','treasury','sales','purchases','Profitloss','Salesreturns','Purchreturns','Discountearned','Discountpermitted','userID','orgID'
    ];




}

