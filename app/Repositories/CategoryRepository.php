<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function getModel()
    {
        return Category::class;
    }

    public function getByLink($link)
    {
        return $this->_model->where('url_category', $link)
            ->where('status', Constant::STATUS_ACTIVE)
            ->first();
    }

    public function getHomeCategories($limit = 5)
    {
        return $this->_model
            ->where('status', Constant::STATUS_ACTIVE)
            ->where('show_home', Constant::STATUS_ACTIVE)
            ->limit($limit)
            ->get();
    }
}
