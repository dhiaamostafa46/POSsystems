<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Accounting_guide extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'accounting_guides';

    protected $fillable = [
        'AccountID','AccountName','AccountNameEn','type','maxAccount','minAccount','Account_Source','Account_status','SourceID','typeProcsss','orgID'
    ];




    public function OpenBalances() {
        return $this->hasMany('App\Models\OpeningBalances','AccountID');
    }
    public function ReportData()
    {
        return $this->hasOne('App\Models\ReportData','AccountID');
    }



    public function AccountingGuide() {
        return $this->hasMany('App\Models\Accounting_guide' ,'SourceID' ,'AccountID')->where('orgID' ,auth()->user()->orgID);
    }


}
