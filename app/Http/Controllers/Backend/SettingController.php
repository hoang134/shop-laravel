<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\SettingRequest;
use App\Helpers\HelpersFun;

class SettingController extends Controller
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function index()
    {
        $setting = $this->settingRepository->getAll()->first();
        return view('backend.modules.settings.index', compact('setting'));
    }

    public function update(SettingRequest $request)
    {
        $setting = $this->settingRepository->getAll()->first();
        if (!$setting) {
            $setting = new Setting();
        }
        $logo = $setting->logo;
        $logo_mobile = $setting->logo_mobile;

        if($request->hasFile('logo')) {
            if($setting) {
                HelpersFun::deleteImage(storage_path('/app/public/') . $setting->logo);
            }
            $logo = HelpersFun::getNameImage($request->file('logo'), 'setting', 'logo');
        }

        if($request->hasFile('logo_mobile')) {
            if($setting) {
                HelpersFun::deleteImage(storage_path('/app/public/') . $setting->logo);
            }
            $logo_mobile = HelpersFun::getNameImage($request->file('logo_mobile'), 'setting', 'logo_mobile');
        }

        $data['logo'] = !empty($logo) ? $logo : NULL;
        $data['logo_mobile'] = !empty($logo_mobile) ? $logo_mobile : NULL;
        $data['company'] = $request->company;
        $data['address'] = $request->address;
        $data['hotline'] = $request->hotline;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['facebook_url'] = $request->facebook_url;
        $data['information_services'] = $request->information_services;
        $data['information_bank'] = $request->information_bank;

        try {
            $this->settingRepository->update(1, $data);
            return redirect()->route('settings.index')->with('success', __('messages.general.success'));
        } catch (\Exception $e) {
            return redirect()->route('settings.index')->with('danger', __('messages.general.error'));
        }
    }

    public function deleteImage($row)
    {

        $setting = Setting::orderByDesc('id')->first();

        try {
            if($row == 'logo') {
                HelpersFun::deleteImage($setting->logo);
                $setting->logo = NULL;
            } else {
                HelpersFun::deleteImage($setting->image_banner);
                $setting->image_banner = NULL;
            }
            $setting->save();
            return redirect()->route('home.index')->with('success', '処理に成功しました。');
        } catch (\Exception $exception) {
            return redirect()->route('home.index')->with('danger', 'エラーが発生しました');
        }
    }
}
