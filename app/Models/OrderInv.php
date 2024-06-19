<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderInv extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'order_invs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','userID','customerID','type','status','totalwvat','totalvat','NameAcount','AccountID','salaseAccount',"kind"
    ];


    public function orderdetails()
    {
        return $this->hasMany('App\Models\OrderinvDetails','orderID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function Customer()
    {
        return $this->belongsTo('App\Models\Customer','customerID');
    }

    public function receive()
    {
        return $this->hasMany('App\Models\Invoice','orderID');
    }
    public function table()
    {
        return $this->belongsTo('App\Models\Tbl','tblNo');
    }
    
        public function OrderRow()
    {
        return $this->hasMany('App\Models\OrderRow','orderId');
    }

    public function OrderRowDetalis()
    {
        return $this->hasMany('App\Models\OrderRowDetalis','orderId');
    }
}
