<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProfileInfServices extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'profile_inf_services';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'orgID','name','disc','img'
    ];



}
