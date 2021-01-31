<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constant;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use App\Helpers\HelpersFun;
use App\Models\Page;
use App\Repositories\PageRepository;

class PageController extends Controller
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Page::class);
        $pages = $this->pageRepository->getAndPaginate(10);
        return view('backend.modules.pages.index', compact('pages'));
    }

    public function create()
    {
        $this->authorize('create', Page::class);
        return view('backend.modules.pages.add');

    }

    public function store(PageRequest $request)
    {
        $this->authorize('create', Page::class);
        $data = $request->except('_token', 'url_image');
        $data['url_page'] = saveUrl($request->title);
        $data['user_id'] = auth()->id();
        if($request->hasFile('url_image')) {
            $image = HelpersFun::getNameImage($request->file('url_image'), 'pages', $data['url_page']);
            $data['url_image'] = $image;
        }
        try {
            $this->pageRepository->create($data);
            return redirect()->route('pages.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }

    }

    public function edit($id)
    {
        $page = $this->pageRepository->find($id);
        if(!$page) {
            return redirect()->route('pages.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('update', $page);
        return view('backend.modules.pages.edit', compact('page'));
    }

    public function update(PageRequest $request, $id)
    {
        $page = $this->pageRepository->find($id);
        if(!$page) {
            return redirect()->route('pages.index')->with('danger', __('messages.general.error'));
        }

        $this->authorize('update', $page);

        $data = $request->except('_token', 'url_image');
        $data['url_page'] = saveUrl($request->title);
        $data['user_id'] = auth()->id();
        if($request->hasFile('url_image')) {
            HelpersFun::deleteImage(storage_path('/app/public/') . $page->url_image);
            $image = HelpersFun::getNameImage($request->file('url_image'), 'pages', $data['url_page']);
            $data['url_image'] = $image;
        }

        try {
            $page->update($data);
            return redirect()->route('pages.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function destroy($id)
    {
        $page = $this->pageRepository->find($id);
        if(!$page) {
            return redirect()->route('pages.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('delete', $page);

        try {
            $this->pageRepository->update($id, ['status' => Constant::STATUS_DELETED]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function restore($id)
    {
        $this->authorize('restore', Page::class);
        $page = $this->pageRepository->find($id);
        if(!$page) {
            return redirect()->route('pages.index')->with('danger', __('messages.general.not_found'));
        }

        try {
            $this->pageRepository->update($id, ['status' => Constant::STATUS_ACTIVE]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }
}
