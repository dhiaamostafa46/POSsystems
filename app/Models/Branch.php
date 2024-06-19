<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Branch extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'branches';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAr','nameEn','area','city','district','addressAr','addressEn','long','lat','status','sectionID'
    ];

    // public function sales()
    // {
    //     return $this->hasMany('App\Models\Order','branchID')->where('created_at','>=',session('dateFrom'))
    //     ->where('created_at','<=',session('dateTo'))->where('orgID', auth()->user()->orgID)->where('kind','=','0');
    // }


    public function salesInv()
    {
        return $this->hasMany('App\Models\OrderInv','branchID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('TypeInv' ,2);
    }

    public function purchases()
    {
        return $this->hasMany('App\Models\Purchase','branchID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('kind' ,2);
    }
    public function salesRuturn()
    {
        return $this->hasMany('App\Models\Order','branchID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('kind','=','4');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Order','branchID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('TypeInv' ,1);
    }


    public function Credorder()
    {
        return $this->hasMany('App\Models\Credorder','branchID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'));
    }

    public function Debitorder()
    {
        return $this->hasMany('App\Models\Debitorder','branchID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'));
    }

    // public function purchases()
    // {
    //     return $this->hasMany('App\Models\Purchase','branchID')->where('created_at','>=',session('dateFrom'))
    //     ->where('created_at','<=',session('dateTo'))->where('kind','=','1');
    // }

    public function purchasesRurturn()
    {
        return $this->hasMany('App\Models\Purchase','branchID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('kind','=','2');
    }

   
      public function outcomes()
    {
        return $this->hasMany('App\Models\Expenses','branchID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('type',2);
    }
    public function DepotStore()
    {
        return $this->hasMany('App\Models\DepotStore','branchID');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock','branchID');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }

    public function durations()
    {
        return $this->hasMany('App\Models\Duration','branchID')->orderBy('id','DESC');
    }

    public function duration()
    {
        return $this->hasMany('App\Models\Duration','branchID')->orderBy('id','DESC')->first();
    }
    
    
       public function table()
    {
        return $this->hasMany('App\Models\Tbl','branchID');
    }

}
