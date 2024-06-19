<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Outcomecategory extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'outcomecategories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','status','AccountID','TypeAccount','GuidesID'
    ];

    public function Accounting_guide()
    {
        return $this->belongsTo('App\Models\Accounting_guide','GuidesID');
    }

    public function outcomes()
    {
        return $this->hasMany('App\Models\Outcome','categoryID');
    }

}
