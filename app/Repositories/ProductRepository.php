<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function getModel()
    {
        return Product::class;
    }

    public function getByLink($link)
    {
        return $this->_model->with('category')
            ->where('url_product', $link)
            ->where('status', Constant::STATUS_ACTIVE)
            ->first();
    }

    public function searchByName($keyword, $sort = null, $limit = 10)
    {
        $query = $this->_model->with('category')
            ->where('status', Constant::STATUS_ACTIVE)
            ->where('name', 'like', "%$keyword%");
        if ($sort) {
            $query->orderBy('price', $sort);
        } else {
            $query->orderBy('id', 'DESC');
        }
        return $query->paginate($limit);
    }

    public function getNewProducts($limit = 5)
    {
        return $this->_model
            ->where('status', Constant::STATUS_ACTIVE)
            ->orderByDesc('id')
            ->limit($limit)
            ->get();
    }

    public function getDataProductByName($productName)
    {
        return $this->_model->query()
            ->where('name', 'like', "%$productName%");
    }
}
