<?php

namespace App\Http\ViewComposers;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\View\View;
use App\Helpers\Constant;

class HeaderComposer
{
    public function compose(View $view) {

        $pages = Page::limit(5)->get();
        $setting = Setting::first();
        $menus = Menu::where([['status', Constant::STATUS_ACTIVE], ['parent_id', NULL]])->get();
        \Illuminate\Support\Facades\View::share([
            'setting' => $setting,
            'pages' => $pages,
            'menus' => $menus,
            'cart' => session()->get('cart') ?? []
        ]);
    }

}
