<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Costcenteer extends Model
{



    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'costcenteers';

    protected $fillable = [
        'CostName','CostNameEN','CostCodeID','dataCost','MainCost','orgID'
    ];








}
