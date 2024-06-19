<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ReportData extends Model
{

    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'report_data';

    protected $fillable = [
        'orgID','debitFrist','creditFrist','debitSecond','creditSecond','debitThird','creditThird','AccountID'
    ];



  

}
