<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\Page;

class PageRepository extends BaseRepository
{
    public function getModel()
    {
        return Page::class;
    }

    public function getByLink($link)
    {
        return $this->_model
            ->where('url_page', $link)
            ->where('status', Constant::STATUS_ACTIVE)
            ->first();
    }

    public function getNewPages($limit = 5)
    {
        return $this->_model
            ->where('status', Constant::STATUS_ACTIVE)
            ->orderByDesc('id')
            ->limit($limit)
            ->get();
    }
}
