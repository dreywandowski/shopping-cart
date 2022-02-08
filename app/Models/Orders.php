<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array'
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()->where('user', 'orders')
            : static::where('user', 'orders')
                ->where(function($q) use ($query) {
                    $q
                        ->where('ref', 'LIKE', '%'. $query . '%')
                        ->orWhere('pay_type', 'LIKE', '%' . $query . '%')
                        ->orWhere('amount', 'LIKE ', '%' . $query . '%')
                        ->orWhere('updated_at', 'LIKE ', '%' . $query . '%');
                });
    }
}
