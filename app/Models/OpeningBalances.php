<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OpeningBalances extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'opening_balances';

    protected $fillable = [
        'nameAccount','CodeAccount','Debit','Credit','date','desc','UserID','AccountID','orgID'
    ];




    public function user()
    {
        return $this->belongsTo('App\Models\User','UserID');
    }


    public function Accounting_guide()
    {
        return $this->belongsTo('App\Models\Accounting_guide','AccountID');
    }


}
