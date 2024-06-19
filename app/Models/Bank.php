<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Bank extends Model
{

    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'banks';

    protected $fillable = [
        'nameBank','AccountID','Country','currency','NameAccountBank','IBN','NumAcounnt','amount','status','desc','permissions','orgID'
    ];
    

}
