<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doc extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'documents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','empID','typeID','category','doc','Status'
    ];

    public function employees()
    {
        return $this->belongsTo('App\Models\Employee','empID')->where('Status',1);
    }
    public function doctype()
    {
        return $this->belongsTo('App\Models\DocType','typeID');
    }

}
