<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderRow extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    protected $table = 'orderrow';

    protected $fillable = [
        'orgID','after','sort','name','orderId'
    ];



}
