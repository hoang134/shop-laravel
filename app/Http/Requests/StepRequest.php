<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepRequest extends FormRequest
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
            'title' => 'required | max:255 ',
            'step' => 'required | max:255 ',
        ];
    }

    public function messages()
    {
        return [
            'step.required' => 'ステップを入力してください。',
            'step.max' => 'タイトル は 255 文字以内で入力してください。',
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトル は 255 文字以内で入力してください。',
        ];
    }
}
