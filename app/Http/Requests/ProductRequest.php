<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255 ',
            'url_image' => ['image', 'mimes:jpeg,jpg,png', 'max:8192'],
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0'
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('labels.product.name'),
            'url_image' => __('labels.product.image'),
            'price' => __('labels.product.price'),
            'quantity' => __('labels.product.quantity')
        ];
    }
}
