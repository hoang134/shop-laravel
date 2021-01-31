<?php

namespace App\Http\Requests\Order;

use App\Helpers\Constant;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class FastPurchaseRequest extends FormRequest
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
            'name' => 'required|min:2|max:50',
            'address' => 'nullable|min:2|max:255',
            'phone' => [
                'required',
                'regex:' . Constant::REGEX_PHONE
            ],
            'email' => 'nullable|email',
            'quantity' => 'required|min:1',
            'product_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('labels.customer.name'),
            'address' => __('labels.customer.address'),
            'phone' => __('labels.customer.phone'),
            'email' => __('labels.customer.email'),
            'quantity' => __('labels.cart.quantity'),
        ];
    }
}
