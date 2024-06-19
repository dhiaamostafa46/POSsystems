<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Expenses extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'expenses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orgID','branchID','total',
        'vat','invoce','type','typepement','date','account','expaccount','userID','status','file'
    ];





    public function ExpensDetails()
    {
        return $this->hasMany('App\Models\ExpensDetails','expensID');
    }









}
