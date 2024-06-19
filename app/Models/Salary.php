<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Salary extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'salaries';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','empID','basicSalary','fullSalary','Status'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','empID')->where('status',1);
    }
    public function Empallowan()
    {
        return $this->hasMany('App\Models\Empallowan','salID');
    }

}
