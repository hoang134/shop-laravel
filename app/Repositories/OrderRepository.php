<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\Order;
use Carbon\Carbon;

class OrderRepository extends BaseRepository
{
    public function getModel()
    {
        return Order::class;
    }

    public function getOrderByStatus($status)
    {
        $from = Carbon::now()->startOfDay();
        $to = Carbon::now()->endOfDay();
        $result = $this->_model
            ->where('status', $status)
            ->whereBetween('created_at', [$from, $to])
            ->get()->count();
        return $result;
    }

    public function getOrderByCode($code)
    {
        return $this->_model
            ->where('status', Constant::STATUS_NEW)
            ->where('code', $code)
            ->first();
    }

    public function getDataOrder($params)
    {
        $query =  $this->_model->with('customer');

        $code = $params['code'];
        $nameCustomer = $params['name_customer'];
        $phone = $params['phone'];

        $query->whereHas('customer', function ($q) use ($nameCustomer, $phone) {
            if ($nameCustomer) {
                $q->where('name', 'like', "%$nameCustomer%");
            }
            if ($phone) {
                $q->where('phone', 'like', "%$phone%");
            }
        });

        if ($code) {
            $query->where('code', 'like', "%$code%");
        }

        return $query->get();
    }
}
