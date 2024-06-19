<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Permission extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'permissions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','pageID','roleID','status',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role','roleID');
    }
    public function page()
    {
        return $this->belongsTo('App\Models\Page','pageID');
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
