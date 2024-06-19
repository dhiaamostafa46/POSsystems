<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AssetType extends Authenticatable
{

    
    use HasFactory, Notifiable;
    protected $table = 'assettypes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','nameAr','nameEn','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID')->where('Status',1);
    }

}
