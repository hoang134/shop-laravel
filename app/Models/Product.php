<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'url_product',
        'category_id',
        'description',
        'content',
        'price',
        'quantity',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getUrlImageAttribute()
    {
        $image = $this->images()->first();
        return $image ? $image->url : '';
    }

    public function sortImages($withMainImage = true)
    {
        $images = $this->images()->orderBy('sort_no');
        if (!$withMainImage) {
            $images->where('sort_no', '<>', 0);
        }
        return $images->get();
    }
}
