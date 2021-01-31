<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'url_image',
        'url_page',
        'description',
        'content',
        'route',
        'status',
    ];
}
