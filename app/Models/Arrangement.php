<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Arrangement extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'arrangements';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branch','userID','type','comment','status','items'
    ];



    public function ArrangementDetails() {
        return $this->hasMany('App\Models\ArrangementDetails','idConvert');
    }
    public function DepotStore()
    {
        return $this->belongsTo('App\Models\DepotStore','branch');
    }



    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }


    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function stockinout()
    {
        return $this->hasMany('App\Models\Stockinout','stockinoutID');
    }
}
