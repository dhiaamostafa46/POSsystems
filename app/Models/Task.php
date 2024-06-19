<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'task';

    protected $fillable = [
        'orgID','title','desc','done','status','flage','group','emp'
    ];


    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','emp')->where('status',1);
    }


    public function Department()
    {
        return $this->belongsTo('App\Models\Department','group')->where('status',1);
    }



    public function Taskdetails()
    {
        return $this->hasMany('App\Models\Taskdetails','taskid');
    }


}
