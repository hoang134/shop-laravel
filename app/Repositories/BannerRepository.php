<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\Banner;

class BannerRepository extends BaseRepository
{
    public function getModel()
    {
        return Banner::class;
    }

    public function getNewBanners($position,$limit = 5 )
    {
        return $this->_model
            ->where('status', Constant::STATUS_ACTIVE)
            ->where('position', $position)
            ->orderByDesc('id')
            ->limit($limit)
            ->get();
    }
}
