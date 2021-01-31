<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'total',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
