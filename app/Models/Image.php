<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'product_id',
        'url',
        'sort_no',
    ];

    public function images()
    {
        return $this->belongsTo(Product::class);
    }
}
