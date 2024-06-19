<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class VolumeDetail extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'volume_details';
    protected $fillable = [
        'orgID','ProdectId','Quantity','VolumeID','QuantityTotal'
    ];

    



    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }


    public function product()
    {
        return $this->belongsTo('App\Models\Product','ProdectId');
    }

    public function Volume()
    {
        return $this->belongsTo('App\Models\Volume','VolumeID');
    }



}
