<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|max:50',
            'username' => 'required|max:15|unique:users,username,' . auth()->id() . ',id',
            'email' => 'required|email|unique:users,email,' . auth()->id() . ',id',
            'password' => 'required_without:password_check|min:6|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('labels.user.name'),
            'username' => __('labels.user.username'),
            'email' => __('labels.user.email'),
            'password' => __('labels.user.password'),
            'password_check' => __('labels.user.label'),
        ];
    }
}
