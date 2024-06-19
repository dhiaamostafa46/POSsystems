<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use App\Models\Contract;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'employees';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //`orgID``branchID``depID``subDepID``jobID``salaryID``nameAr``nameEn``nationality``area``city``addressAr``addressEn``phone``email``jobClass``idNo``marriedStatus``sonCount``idEndDate``hireDate`
    protected $fillable = [
        'orgID','branchID','userID','depID','subDepID','jobID','salaryID','nameAr','nameEn','nationality','area','city','addressAr','addressEn','phone','email','jobClass','idNo','marriedStatus','sonCount','salary','idEndDate','hireDate'
    ];
   /*
    public function salary()
    {
        return $this->belongsTo('App\Models\Salary','salaryID');
    }*/

    public function job()
    {
        return $this->belongsTo('App\Models\Job','jobID');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }
    public function depart()
    {
        return $this->belongsTo('App\Models\Department','depID');
    }
    public function brnanch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }
    public function contract($id)
    {
        return Contract::where('empID',$id)->first();
        // return $this->belongsTo('App\Models\Contract','empID');
    }
    public function shift()
    {
        return $this->belongsTo('App\Models\Shift','shiftID');
    }
    public function created_at_difference($date)
    {
           return Carbon::createFromTimestamp(strtotime($date))->diff(Carbon::now())->days;
    }

    public function Salary()
    {
        return $this->hasOne('App\Models\Salary','empID');
    }

    public function Empallowan()
    {
        return $this->hasMany('App\Models\Empallowan','empID');
    }

}
