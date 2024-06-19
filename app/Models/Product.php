<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Product extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAr','nameEn','detailsAr','detailsEn','calories','costPrice','prodPrice','vat','isParent','parentID','sFrom','sTo'
        ,'orgID','userID','categoryID','kitchenID','barcode','img','status'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Prodcategory','categoryID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','userID');
    }



    public function Volume()
    {
        return $this->hasOne('App\Models\Volume','ProdectID');
    }


    public function CostStore()
    {
        return $this->hasOne('App\Models\CostStore','productID');
    }


    public function unit()
    {
        return $this->belongsTo('App\Models\Unit','unitID');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock','productID');
    }


    public function unitprodect()
    {
        return $this->hasMany('App\Models\ProdUnit','prodID');
    }


    public function unitprodectcomment()
    {
        return $this->hasMany('App\Models\ProdUnit','prodID')->where('compon','1');
    }

    public function unitprodectcommentbreanch()
    {
        $br=Branch::findorFail(auth()->user()->branchID);
        return $this->hasMany('App\Models\ProdUnit','prodID')->where('compon','1')->where('StoreId', $br->DepotStore[0]->id);
    }


    public function unitprobreanch()
    {
        $br=Branch::findorFail(auth()->user()->branchID);
        return $this->hasMany('App\Models\ProdUnit','prodID')->where('StoreId', $br->DepotStore[0]->id);
    }

    public function extras()
    {
        return $this->hasMany('App\Models\Extra','productID');
    }

    public function compUnit()
    {
        return $this->belongsTo('App\Models\Unit','componUnit');
    }
    public function salUnit()
    {
        return $this->belongsTo('App\Models\Unit','saleUnit');
    }
    public function purUnit()
    {
        return $this->belongsTo('App\Models\Unit','purhaseUnit');
    }
    public function repoUnit()
    {
        return $this->belongsTo('App\Models\Unit','reportUnit');
    }

    public function stocksWhere()
    {
        return $this->hasMany('App\Models\Stock','productID')->where('created_at','>=',session('dateFrom'))
        ->where('created_at','<=',session('dateTo'));
    }
     public function org()
    {
        return $this->belongsTo('App\Models\Organization','orgID');
    }
    
}
