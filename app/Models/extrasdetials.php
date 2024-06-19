<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class extrasdetials extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'extrasdetials';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAr','price', 'orgID','userID','productID','IDorder'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product','productID');
    }


    public function Orderdetails()
    {
        return $this->belongsTo('App\Models\Orderdetails','IDorder');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }
}
