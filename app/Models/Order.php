<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'total',
    ];

    // Связь с таблицей order_products
    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
