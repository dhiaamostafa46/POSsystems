<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MessageNadel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'messagenadel';

    protected $fillable = [
        'orgID','branchID','msg'
    ];
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'orgID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'branchID');
    }

}
