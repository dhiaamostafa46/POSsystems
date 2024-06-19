<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CostStore extends Model
{


    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'cost_stores';

    protected $fillable = [
        'orgID','branchID','productID','count','costprodect','saller','countSaller'
    ];



    

    public function product()
    {
        return $this->belongsTo('App\Models\Product','productID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }

}
