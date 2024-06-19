<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class JournalSub extends Model
{

    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'journal_subs';

    protected $fillable = [
        'nameAccount','CodeAccount','Debit','Credit','dec','CostCenter','journalID','AccountID'
    ];



    public function Accounting_guide()
    {
        return $this->belongsTo('App\Models\Accounting_guide','AccountID');
    }

    // public function JournalSubFather()
    // {
    //     return $this->belongsTo(Journal::class, 'journalID');
    // }
    public function JournalSubFather()
    {
        return $this->belongsTo('App\Models\Journal');
    }
}
