<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Manufactur extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'manufacturs';

    protected $fillable = [
        'orgID','branchID','productID','Quantity','totalcost','desc','date','VolumeID'
    ];




    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }

    public function Manufacturdetials() {
        return $this->hasMany('App\Models\Manufacturdetials','VolumeID');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','productID');
    }

    public function Unit()
    {
        return $this->belongsTo('App\Models\Unit','unit');
    }

}







