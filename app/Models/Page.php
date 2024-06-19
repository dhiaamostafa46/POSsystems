<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Page extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'pages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','nameAr','nameEn','status',
    ];

    public function permissions()
    {
        return $this->hasMany('App\Models\Permission','pageID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branchID');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Pagecategory','categoryID');
    }



}
