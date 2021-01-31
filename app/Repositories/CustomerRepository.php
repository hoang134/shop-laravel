<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends BaseRepository
{
    public function getModel()
    {
        return Customer::class;
    }

    public function searchByName($keyword)
    {
        return $this->_model->where('name', 'like', "%$keyword%")
            ->paginate(10);
    }
}
