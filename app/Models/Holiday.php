<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Holiday extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'holidaysrequests';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    protected $fillable = [
        'orgID','empID','typeID','days','from','to','details','approved','approvedBy','approvedBy','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\AssetType','typeID');
    }
    public function car()
    {
        return $this->belongsTo('App\Models\Car','carID');
    }
    
    public function created_at_difference($st,$en)
    {
         $start  = new Carbon($st);
         $end    = new Carbon($en);
          
         if(($en == 0) || ($end->lte($start)))
         {
             return 0;
         }
        
         //Carbon::createFromTimestamp(strtotime($st))->diff(Carbon::now())
          // return $start->diff($end)->format('%H:%I:%S');
           return $start->diffInDays($end);
    } 
}
