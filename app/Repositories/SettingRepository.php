<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository extends BaseRepository
{
    public function getModel()
    {
        return Setting::class;
    }
}
