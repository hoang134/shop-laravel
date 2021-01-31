<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:255 ',
            'url_image' => ['image', 'mimes:jpeg,jpg,png', 'max:8192'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('labels.post.title'),
            'url_image' => __('labels.post.image'),
        ];
    }
}
