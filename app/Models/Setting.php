<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $table = 'settings';
    protected $fillable = [
        'logo',
        'logo_mobile',
        'company',
        'address',
        'hotline',
        'phone',
        'email',
        'facebook_url',
        'information_services',
        'information_bank',
    ];
}
