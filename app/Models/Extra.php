<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Extra extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'extras';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAr','nameEn','price',
        'orgID','userID','productID','status'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product','productID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

}
