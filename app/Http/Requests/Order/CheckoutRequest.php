<?php

namespace App\Http\Requests\Order;

use App\Helpers\Constant;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'address' => 'required|min:2|max:255',
            'phone' => [
                'required',
                'regex:' . Constant::REGEX_PHONE
            ],
            'email' => 'nullable|email',
            'payment_id' => 'required|in:' . Order::PAYMENT_TRANSFER . ',' . Order::PAYMENT_COD,
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('labels.customer.name'),
            'address' => __('labels.customer.address'),
            'phone' => __('labels.customer.phone'),
            'email' => __('labels.customer.email'),
            'payment_id' => __('labels.order.payment_method'),
        ];
    }
}
