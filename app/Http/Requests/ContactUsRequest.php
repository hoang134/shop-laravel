<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            //
            'name' =>['required','max:191'],
            'email' => 'required | email ',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください。',
            'email.required' => 'あなたのメールアドレスを入力してください',
            'email.email' => '正しいメール形式を入力してください',
        ];
    }
}
