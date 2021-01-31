<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constant;
use App\Http\Requests\BannerRequest;
use App\Http\Controllers\Controller;
use App\Helpers\HelpersFun;
use App\Models\Banner;
use App\Repositories\BannerRepository;

class BannerController extends Controller
{
    protected $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index()
    {
        $banners = $this->bannerRepository->getAndPaginate(10);
        return view('backend.modules.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.modules.banners.add');

    }

    public function store(BannerRequest $request)
    {
        $data = $request->except('_token');
        if($request->hasFile('url_image')) {
            $image = HelpersFun::getNameImage($request->file('url_image'), 'banners', saveUrl($request->title));
            $data['url_image'] = $image;
            $data['url_link'] = !empty($data['url_link']) ? $data['url_link'] : '';
        }
        try {
            $this->bannerRepository->create($data);
            return redirect()->route('banners.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }

    }

    public function edit($id)
    {
        $banner = $this->bannerRepository->find($id);
        if(!$banner) {
            return redirect()->route('banners.index')->with('danger', __('messages.general.not_found'));
        }
        return view('backend.modules.banners.edit', compact('banner'));
    }

    public function update(BannerRequest $request, $id)
    {
        $banner = $this->bannerRepository->find($id);
        if(!$banner) {
            return redirect()->route('banners.index')->with('danger', __('messages.general.error'));
        }

        $data = $request->except('_token');
        if($request->hasFile('url_image')) {
            HelpersFun::deleteImage(storage_path('/app/public/') . $banner->url_image);
            $image = HelpersFun::getNameImage($request->file('url_image'), 'banners', saveUrl($request->title));
            $data['url_image'] = $image;
            $data['url_link'] = !empty($data['url_link']) ? $data['url_link'] : '';
        }

        try {
            $banner->update($data);
            return redirect()->route('banners.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function destroy($id)
    {
        $banner = $this->bannerRepository->find($id);
        if(!$banner) {
            return redirect()->route('banners.index')->with('danger', __('messages.general.not_found'));
        }

        try {
            $this->bannerRepository->update($id, ['status' => Constant::STATUS_DELETED]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function restore($id)
    {
        $banner = $this->bannerRepository->find($id);
        if(!$banner) {
            return redirect()->route('banners.index')->with('danger', __('messages.general.not_found'));
        }

        try {
            $this->bannerRepository->update($id, ['status' => Constant::STATUS_ACTIVE]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }
}
