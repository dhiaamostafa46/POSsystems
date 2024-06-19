<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booktable extends Model
{
    use HasFactory;
    protected $table = 'booktable';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['orgID', 'branchID', 'time', 'count', 'name', 'phone', 'customersID'];

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'orgID');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'branchID');
    }

    public function tableGrd()
    {
        return $this->belongsTo('App\Models\Tbl','table');
    }
}
