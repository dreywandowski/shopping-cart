<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'date_consumed';
    use HasFactory;

    protected $casts = [
        'user_who_consumed_coupon_code' => 'array'
    ];
}
