<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Attendance extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'attendance';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','userID','empID','checkTime','distance','lat','lon','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID');
    }


    public function Empallowan()
    {
        return $this->hasMany('App\Models\Empallowan','allowID')->where('status',1);
    }

    public function created_at_difference($st,$en)
    {
        $start  = new Carbon($st);
         $end    = new Carbon($en);
          
         if(($en == 0) || ($start->lte($end)))
         {
             return 0;
         }
        
         //Carbon::createFromTimestamp(strtotime($st))->diff(Carbon::now())
           return $start->diff($end)->format('%H:%I:%S');
           //return $start->diffInHours($end);
    } 
     public function workingHours($st,$en)
    {
         $start  = new Carbon($st);
         $end    = new Carbon($en);
          
       
         //Carbon::createFromTimestamp(strtotime($st))->diff(Carbon::now())
           return $start->diff($end)->format('%H:%I:%S');
           //return $start->diffInHours($end);
    } 

    public function toHours($st)
    {
        $start  = new Carbon($st);

        $min =$start->minute;
       
         $stime = ($start->hour * 60) + $min;
          
         return   $stime /60;
    } 

}
