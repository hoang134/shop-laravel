<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:8192'],
            'logo_mobile' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:8192'],
        ];
    }

    public function attributes()
    {
        return [
            'logo' => __('labels.setting.logo'),
            'logo_mobile' => __('labels.setting.logo_mobile'),
            'company' => __('labels.setting.company'),
            'address' => __('labels.setting.address'),
            'hotline' => __('labels.setting.hotline'),
            'phone' => __('labels.setting.phone'),
            'email' => __('labels.setting.email'),
            'facebook_url' => __('labels.setting.facebook_url'),
            'information_services' => __('labels.setting.information_services'),
            'information_bank' => __('labels.setting.information_bank'),
        ];
    }
}
