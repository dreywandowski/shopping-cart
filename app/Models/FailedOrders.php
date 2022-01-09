<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedOrders extends Model
{
    use HasFactory;
    protected $table="failedorders";
    protected $casts = [
        'items' => 'array'
    ];
}
