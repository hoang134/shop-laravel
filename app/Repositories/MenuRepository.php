<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\Menu;

class MenuRepository extends BaseRepository
{
    public function getModel()
    {
        return Menu::class;
    }
}
