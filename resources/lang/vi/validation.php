<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute phải được chọn.',
    'active_url' => ':attribute không phải đường dẫn khả dụng.',
    'after' => ':attribute phải là ngày sau :date.',
    'after_or_equal' => ':attribute phải là :date hoặc một ngày sau đó.',
    'alpha' => ':attribute chỉ có thể bao gồm các chữ cái.',
    'alpha_dash' => ':attribute chỉ có thể bao gồm các kí tự chữ, số, gạch ngang (-) và gạch dưới (_).',
    'alpha_num' => ':attribute chỉ có thể bao gồm các kí tự chữ và số.',
    'array' => ':attribute phải là 1 mảng.',
    'before' => ':attribute phải là ngày trước :date.',
    'before_or_equal' => ':attribute phải là :date hoặc một ngày trước đó.',
    'between' => [
        'numeric' => ':attribute phải là một số trong khoảng từ :min đến :max.',
        'file' => ':attribute phải có độ lớn từ :min đến :max kB.',
        'string' => ':attribute phải có độ dài từ :min đến :max kí tự.',
        'array' => ':attribute phải có từ :min đến :max phần tử.',
    ],
    'boolean' => ':attribute phải là true hoặc false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => ':attribute không phải một ngày hợp lệ.',
    'date_equals' => ':attribute phải là ngày trùng với :date.',
    'date_format' => ':attribute không đúng với định dạng :format.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải có :digits chữ số.',
    'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
    'dimensions' => ':attribute có kích thước không hợp lệ.',
    'distinct' => ':attribute có giá trị bị lặp lại.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc với một trong các giá trị: :values',
    'exists' => ':attribute được chọn không hợp lệ.',
    'file' => ':attribute phải là file.',
    'filled' => ':attribute phải được nhập.',
    'gt' => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file' => ':attribute phải lớn hơn :value kB.',
        'string' => ':attribute phải có độ dài lớn hơn hơn :value kí tự.',
        'array' => ':attribute phải có nhiều hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kB.',
        'string' => ':attribute phải có độ dài tối thiểu :value kí tự.',
        'array' => ':attribute phải có tối thiểu :value phần tử.',
    ],
    'image' => ':attribute phải là ảnh.',
    'in' => ':attribute được chọn không hợp lệ.',
    'in_array' => ':attribute không có trong :other.',
    'integer' => ':attribute phải là số nguyên.',
    'ip' => ':attribute phải là 1 địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là 1 địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là 1 địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là 1 chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file' => ':attribute phải nhỏ hơn :value kB.',
        'string' => ':attribute phải có độ dài nhỏ hơn :value kí tự.',
        'array' => ':attribute phải có ít hơn :value phần tử.',
    ],
    'lte' => [
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kB.',
        'string' => ':attribute có độ dài tối đa :value kí tự.',
        'array' => ':attribute có thể có tối đa :value phần tử.',
    ],
    'max' => [
        'numeric' => ':attribute không thể lớn hơn :max.',
        'file' => ':attribute không thể lớn hơn :max kB.',
        'string' => ':attribute không thể dài hơn :max kí tự.',
        'array' => ':attribute không thể có nhiều hơn :max phần tử.',
    ],
    'mimes' => ':attribute phải là tệp có định dạng: :values.',
    'mimetypes' => ':attribute phải là tệp có định dạng: :values.',
    'min' => [
        'numeric' => ':attribute phải bằng tối thiểu :min.',
        'file' => ':attribute phải tối thiểu :min kB.',
        'string' => ':attribute phải dài tối thiểu :min kí tự.',
        'array' => ':attribute phải có tối thiểu :min phần tử.',
    ],
    'not_in' => ':attribute được chọn không hợp lệ.',
    'not_regex' => ':attribute có định dạng không hợp lệ.',
    'numeric' => ':attribute phải là số.',
    'present' => 'Trường :attribute phải tồn tại.',
    'regex' => ':attribute có định dạng không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other thuộc :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi :values tồn tại.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi :values tồn tại.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values không tồn tại.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi :values không tồn tại.',
    'same' => ':attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => ':attribute phải là :size.',
        'file' => ':attribute phải có độ lớn là :size kB.',
        'string' => ':attribute phải có độ dài :size kí tự.',
        'array' => ':attribute phải bảo gồm :size phần tử.',
    ],
    'starts_with' => ':attribute phải bắt đầu với một trong các giá trị: :values',
    'string' => ':attribute phải là chuỗi.',
    'timezone' => ':attribute phải là 1 múi giờ hợp lệ.',
    'unique' => ':attribute đã tồn tại.',
    'uploaded' => ':attribute không thể tải lên.',
    'url' => ':attribute có định dạng không hợp lệ.',
    'uuid' => ':attribute phải là một UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
