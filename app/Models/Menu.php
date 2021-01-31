<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Constant;

class Menu extends Model
{
    //
    protected $table = 'menus';
    protected $fillable = [
        'name',
        'url_menu',
        'parent_id',
        'status'
    ];

    public function childMenu()
    {
        return $this->hasMany(Menu::class, 'parent_id')->where('status', Constant::STATUS_ACTIVE);
    }
}
