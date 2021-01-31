<?php

namespace App\Http\Requests\Order;

use App\Helpers\Constant;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'id' => 'nullable|exists:customers,id',
            'name' => 'required_without:id|min:2|max:50',
            'address' => 'nullable|min:2|max:100',
            'phone' => [
                'required_without:id',
                'regex:' . Constant::REGEX_PHONE
            ],
            'email' => 'nullable|email',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|min:1',
            'payment_id' => 'required|in:1,2',
        ];
    }

    public function attributes()
    {
        return [
            'id' => __('labels.customer.label'),
            'name' => __('labels.customer.name'),
            'address' => __('labels.customer.address'),
            'phone' => __('labels.customer.phone'),
            'email' => __('labels.customer.email'),
            'products.*.quantity' => __('labels.product.quantity'),
        ];
    }
}
