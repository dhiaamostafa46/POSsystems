<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Prodcategory extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'prodcategories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAr','nameEn','sFrom','sTo','status','TypeCatagoury'
    ];



    public function products()
    {
        return $this->hasMany('App\Models\Product','categoryID')->where('status',1);
    }

    public function producTKat()
    {
        return $this->hasMany('App\Models\Product','categoryID')->where('status',1)->where('orgID',auth()->user()->orgID)->where('TypeProdect',1)->orWhere('saleable',1);
    }

}
