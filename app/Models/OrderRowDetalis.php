<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRowDetalis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'orderrowdetails';


    protected $fillable = [
        'orgID','after','sort','name','orderId'
    ];

    
}
