<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Organization extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'organizations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAr','nameEn','vatNo','CR','logo','status','isNew','isPaid'
    ];

    public function branches()
    {
        return $this->hasMany('App\Models\Branch','orgID');
    }

    public function prodcategories()
    {
        return $this->hasMany('App\Models\Prodcategory','orgID')->where('status',1);
    }





    public function Employee()
    {
        return $this->hasMany('App\Models\Employee','orgID');
    }


     public function DepotStore()
    {
        return $this->hasMany('App\Models\DepotStore','orgID');
    }

    public function prodcategoriesKatcSaller()
    {
        return $this->hasMany('App\Models\Prodcategory','orgID')->where('status',1)->where('TypeCatagoury',1);
    }

    public function prodcategoriesKatPuches()
    {
        return $this->hasMany('App\Models\Prodcategory','orgID')->where('status',1)->where('TypeCatagoury',2);
    }
    public function productTsnee()
    {
        return $this->hasMany('App\Models\Prodcategory','orgID')->where('status',1)->where('TypeCatagoury',3);
    }


    public function pagecategories()
    {
        return $this->hasMany('App\Models\Pagecategory','orgID')->where('status',1);
    }

    public function kitchens()
    {
        return $this->hasMany('App\Models\Kitchen','orgID')->where('status',1);
    }

    public function outcomecategories()
    {
        return $this->hasMany('App\Models\Outcomecategory','orgID')->where('status',1);
    }
    
    
     public function PackageList()
    {
        return $this->hasMany('App\Models\PackageList','orgID');
    }

    public function pProducts()
    {
        return $this->hasMany('App\Models\Product','orgID')->where('isParent',1);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product','orgID')->where('status',1);
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit','orgID')->where('status',1);
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer','orgID')->where('status',1);
    }

    public function VirtualCustomer()
    {
        return $this->hasMany('App\Models\VirtualCustomer','orgID');
    }


    public function CostCenter()
    {
        return $this->hasMany('App\Models\Costcenteer','orgID');
    }

    public function suppliers()
    {
        return $this->hasMany('App\Models\Supplier','orgID')->where('status',1);
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Order','orgID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('TypeInv' ,1);
    }


    public function Credorder()
    {
        return $this->hasMany('App\Models\Credorder','orgID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'));
    }

    public function Debitorder()
    {
        return $this->hasMany('App\Models\Debitorder','orgID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'));
    }


    public function salesInv()
    {
        return $this->hasMany('App\Models\OrderInv','orgID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('TypeInv' ,2);
    }

    public function purchases()
    {
        return $this->hasMany('App\Models\Purchase','orgID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('kind' ,2);
    }

   
    
    
        public function outcomes()
    {
        return $this->hasMany('App\Models\Expenses','orgID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'))->where('type',2);
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock','orgID');
    }

    public function roles()
    {
        return $this->hasMany('App\Models\Role','orgID');
    }

    public function banners()
    {
        return $this->hasMany('App\Models\Banner','orgID');
    }

    public function shifts()
    {
        return $this->hasMany('App\Models\Shift','orgID');
    }

       public function User()
    {
        return $this->belongsTo('App\Models\User','userID');
    }
    public function StoreColor()
    {
        return $this->belongsTo('App\Models\OrgSetting','orgID');
    }
    
    
    public function Subscribtion()
    {
        return $this->hasOne('App\Models\Subscribtion','orgID');
    }

}
