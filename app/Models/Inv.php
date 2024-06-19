<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Inv extends Model
{


    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'invs';

    protected $fillable = [
        'Inv','orgID'
    ];

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }

}
