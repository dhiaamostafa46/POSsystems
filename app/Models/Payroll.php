<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Payroll extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'payrolls';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    protected $fillable = [
        'orgID','empID','salID','allowns','deducts','fullAllowns','fullDeducts','netSalary','month','Status'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','empID');
    }
    public function salary()
    {
        return $this->belongsTo('App\Models\Salary','salID');
    }

}
