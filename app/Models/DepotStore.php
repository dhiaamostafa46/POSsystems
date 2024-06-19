<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DepotStore extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'depot_stores';

    protected $fillable = [
        'orgID','branchID', 'name','AccountID','status','main','GuidesID'
    ];



    public function Accounting_guide()
    {
        return $this->belongsTo('App\Models\Accounting_guide','GuidesID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }


    public function Stock()
    {
        return $this->hasMany('App\Models\Stock','depotID','id');
    }

}
