<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Journal extends Model
{


    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'journals';

    protected $fillable = [
        'Debit','Credit','dec','Total','Ref','Type','userID','date','kind','Items','orgID'
    ];

    // function JournalChild()
    // {
    //     return $this->hasMany(JournalSub::class,'journalID' ,'id');

    // }








    public function JournalChild() {
        return $this->hasMany('App\Models\JournalSub','journalID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }



}
