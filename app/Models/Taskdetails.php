<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Taskdetails extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'taskdetails';

    protected $fillable = [
        'orgID','taskid','desc','emp'
    ];



    public function User()
    {
        return $this->belongsTo('App\Models\User','emp');
    }

}



