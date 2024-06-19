<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ExpensDetails extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'expensdetails';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','total',
        'vat','comment','categoryID','AccountID','nameAccount','outAccount','type','userID','userID','status','expensID'
    ];



    public function category()
    {
        return $this->belongsTo('App\Models\Outcomecategory','categoryID');
    }


    public function Expenses()
    {
        return $this->belongsTo('App\Models\Expenses','expensID');
    }


}
