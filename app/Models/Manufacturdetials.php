<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Manufacturdetials extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'manufacturdetials';
    protected $fillable = [
        'orgID','ProdectId','Quantity','VolumeID','QuantityTotal' ,'unit'
    ];





    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }


    public function product()
    {
        return $this->belongsTo('App\Models\Product','ProdectId');
    }

    public function Manufactur()
    {
        return $this->belongsTo('App\Models\Manufactur','VolumeID');
    }

    public function Unit()
    {
        return $this->belongsTo('App\Models\Unit','unit');
    }
}
