<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Contract extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'contracts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','empID','contractNo','stDate','enDate','contractStatus','file','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID')->where('Status',1);
    }
    public function doctype()
    {
        return $this->belongsTo('App\Models\DocType','typeID');
    }
    
    public function created_at_difference($date ,$date1)
    {
           return Carbon::createFromTimestamp(strtotime($date))->diff( $date1);
    }

    public function Terms()
    {
        return $this->hasMany('App\Models\Terms','contract');
    }

}
