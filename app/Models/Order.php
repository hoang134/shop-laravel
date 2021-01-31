<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    const PAYMENT_TRANSFER = '1';
    const PAYMENT_COD = '2';
    const ORDER_CLOSE = '0';
    const ORDER_NEW = '1';
    const ORDER_PROCESS = '2';
    const ORDER_SUCCESS = '3';

    use SoftDeletes;

    protected $fillable = [
        'code',
        'customer_id',
        'payment_id',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function saveOrderDetails($orderDetails)
    {
        return $this->orderDetails()->createMany($orderDetails);
    }
}
