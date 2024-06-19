<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProfileInfCompany extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'profile_inf_companies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'orgID','Logo','About','Vision','message','imgAbout','gools','Img'
    ];

}
