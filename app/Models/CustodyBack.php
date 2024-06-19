<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class CustodyBack extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'custodybackrequests';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'approveDate' => 'datetime'
    ];

    protected $fillable = [
        'orgID','empID','toEmpID','custID','details','receivedetails','approvedBy','approveDate','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','toEmpID');
    }
    public function employees2()
    {
        return $this->belongsTo('App\Models\Employee','empID');
    }
    public function custody()
    {
        return $this->belongsTo('App\Models\Custody','custID');
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
