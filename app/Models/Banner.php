<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'url_image',
        'url_link',
        'position',
        'status',
    ];
}
