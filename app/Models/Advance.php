<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Advance extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'advancesrequests';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'dueDate' => 'datetime'
    ];
    protected $fillable = [
        'orgID','empID','amount','dueDate','details','approvedBy','approveDate','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID');
    }
   
    
    public function created_at_difference($st,$en)
    {
         $start  = new Carbon($st);
         $end    = new Carbon($en);
          
         if(($en == 0) || ($end->lte($start)))
         {
             return 0;
         }
        
         
           return $start->diffInDays($end);
    } 
}
