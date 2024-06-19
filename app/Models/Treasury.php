<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Treasury extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'treasuries';

    protected $fillable = [
        'AccountCode','name','status','desc','branchID','orgID'
    ];







    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }




}
