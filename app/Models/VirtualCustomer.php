<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class VirtualCustomer  extends Authenticatable
{


    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'virtual_customers';

    protected $fillable = [
        'branchID','name','phone','orgID','userID','vatNo'
    ];




}
