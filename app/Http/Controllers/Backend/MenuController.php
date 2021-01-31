<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constant;
use App\Http\Requests\MenuRequest;
use App\Http\Controllers\Controller;
use App\Helpers\HelpersFun;
use App\Models\Menu;
use App\Repositories\CategoryRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $categoryRepository;
    protected $menuRepository;
    protected $pageRepository;

    public function __construct(CategoryRepository $categoryRepository, MenuRepository $menuRepository, PageRepository $pageRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->menuRepository = $menuRepository;
        $this->pageRepository = $pageRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->filter([['parent_id', Constant::ROOT_CATEGORY], ['status', Constant::STATUS_ACTIVE]]);
        $menus = $this->menuRepository->filter([['parent_id', NULL], ['status', Constant::STATUS_ACTIVE]]);
        $pages = $this->pageRepository->filter([['status', Constant::STATUS_ACTIVE]]);
        return view('backend.modules.menus.index', compact('categories', 'menus', 'pages'));
    }

    public function create()
    {
        $this->authorize('create', Menu::class);
        return view('backend.modules.menus.add');

    }

    public function store(MenuRequest $request)
    {
        $data = $request->except('_token');
        try {
            $this->menuRepository->create($data);
            return redirect()->route('menus.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function edit($id)
    {
        $menu = $this->menuRepository->find($id);
        if (!$menu) {
            return redirect()->route('menus.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('create', $menu);
        return view('backend.modules.menus.edit', compact('menu'));
    }

    public function update(MenuRequest $request, $id)
    {
        $menu = $this->menuRepository->find($id);
        if(!$menu) {
            return redirect()->route('menus.index')->with('danger', __('messages.general.error'));
        }

        $data = $request->except('_token');
        try {
            $menu->update($data);
            return redirect()->route('menus.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function destroy($id)
    {
        $menu = $this->menuRepository->find($id);
        if(!$menu) {
            return redirect()->route('menus.index')->with('danger', __('messages.general.not_found'));
        }
        try {
            $menu->update(['status' => Constant::STATUS_DELETED]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function saveMenu(Request $request)
    {
        $names = $request->get('names');
        $urls = $request->get('urls_menu');
        $parent_ids = $request->get('parent_ids');
        if (empty($names) || empty($urls) || empty($parent_ids)) {
            return redirect()->route('menus.index')->with('danger', __('messages.general.error'));
        }

        try {
            $this->menuRepository->updateAll(['status' => Constant::STATUS_ACTIVE], ['status' => Constant::STATUS_DELETED]);
            $lastId = NULL;
            foreach ($names as $i => $name) {
                $data = [
                    'name' => $name,
                    'url_menu' => $urls[$i],
                    'parent_id' => $parent_ids[$i] ? $lastId : NULL
                ];
                $menu = $this->menuRepository->create($data);
                if (!$parent_ids[$i]) $lastId = $menu->id;
            }
            return redirect()->route('menus.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }
}
