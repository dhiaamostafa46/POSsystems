<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Outcome extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'outcomes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','categoryID','total','comment','img','status','AccountID','nameAccount','outAccount','type'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Outcomecategory','categoryID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }


}

