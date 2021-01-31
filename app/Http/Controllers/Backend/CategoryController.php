<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constant;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Helpers\HelpersFun;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = $this->categoryRepository->getAndPaginate(10);
        return view('backend.modules.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('create', Category::class);
        $parentCats = $this->categoryRepository->filter([['parent_id', '=', Constant::ROOT_CATEGORY], ['status', '=', Constant::STATUS_ACTIVE]]);
        return view('backend.modules.categories.add', compact('parentCats'));
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);
        $data = $request->except('_token');
        $data['url_category'] = saveUrl($request->name);
        try {
            $this->categoryRepository->create($data);
            return redirect()->route('categories.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }

    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        if(!$category) {
            return redirect()->route('categories.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('update', $category);
        $parentCats = $this->categoryRepository->filter([['parent_id', '=', Constant::ROOT_CATEGORY], ['id', '<>', $id], ['status', '=', Constant::STATUS_ACTIVE]]);
        return view('backend.modules.categories.edit', compact('category', 'parentCats'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->find($id);
        if(!$category) {
            return redirect()->route('categories.index')->with('danger', __('messages.general.error'));
        }
        $this->authorize('update', $category);
        $data = $request->except('_token');
        $data['url_category'] = saveUrl($request->name);
        try {
            $category->update($data);
            return redirect()->route('categories.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);
        if(!$category) {
            return redirect()->route('categories.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('delete', $category);
        try {
            $this->categoryRepository->update($id, ['status' => Constant::STATUS_DELETED]);
            $this->categoryRepository->updateAll([['parent_id', '=', $id]], ['status' => Constant::STATUS_INACTIVE]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function restore($id)
    {
        $this->authorize('restore', Category::class);
        $category = $this->categoryRepository->find($id);
        if(!$category) {
            return redirect()->route('categories.index')->with('danger', __('messages.general.not_found'));
        }
        try {
            $this->categoryRepository->update($id, ['status' => Constant::STATUS_ACTIVE]);
            $this->categoryRepository->updateAll([['parent_id', '=', $id]], ['status' => Constant::STATUS_ACTIVE]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }
}
