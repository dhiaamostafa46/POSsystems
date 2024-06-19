<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Volume extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'volumes';

    protected $fillable = [
        'orgID','branchID','userID','ProdectID','VolumdetalsID','nameprodect','desc','countVol','totalPrice'
    ];




    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }

    public function VolumeDetail() {
        return $this->hasMany('App\Models\VolumeDetail','VolumeID');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','ProdectID');
    }


}
