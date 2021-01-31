<?php

namespace App\Helpers;

class Constant
{
    const ROOT_CATEGORY = '0';
    const DEFAULT_PRODUCT = [
        'price' => '0',
        'quantity' => '0'
    ];
    const STATUS_DELETED = '0';
    const STATUS_ACTIVE = '1';
    const STATUS_INACTIVE = '2';
    const STATUS_CLOSE = '0';
    const STATUS_NEW = '1';
    const STATUS_PROCESSING = '2';
    const STATUS_DONE = '3';
    const REGEX_PHONE = '/(0[3|5|7|8|9])+([0-9]{8})$/';
    const PAYMENT_METHOD = [
        'transfer' => 1,
        'cod' => 2
    ];
    const POSITION_SLIDER = '1';
    const POSITION_BANNER = '2';
}
