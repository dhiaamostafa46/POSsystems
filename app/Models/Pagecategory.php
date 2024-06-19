<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pagecategory extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'pagecategories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAr','nameEn','status'
    ];

    public function pages()
    {
        if(auth()->user()->organization->activity == 2){
            return $this->hasMany('App\Models\Page','categoryID');
        }else{
            return $this->hasMany('App\Models\Page','categoryID')->where('flage','!=',2);
        }

    }

}
