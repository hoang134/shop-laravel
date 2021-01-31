<?php

namespace App\Http\Requests\Order;

use App\Helpers\Constant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCartRequest extends FormRequest
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
            'product_id' => [
                'required',
                Rule::exists('products', 'id')->where('status', Constant::STATUS_ACTIVE),
            ],
            'quantity' => 'required|digits_between:1,4|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => __('labels.product.label'),
            'quantity' => __('labels.product.quantity'),
        ];
    }
}
