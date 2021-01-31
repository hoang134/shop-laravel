<?php

namespace App\Models;

use App\Helpers\Constant;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'url_category',
        'parent_id',
        'description',
        'show_home',
        'status',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', Constant::STATUS_ACTIVE);;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productsSort($sort = null, $limit = 15)
    {
        $query = $this->products()->where('status', Constant::STATUS_ACTIVE);
        if ($sort) {
            $query->orderBy('price', $sort);
        } else {
            $query->orderBy('id', 'DESC');
        }
        return $query->paginate($limit);
    }

    public function randomProducts($limit = 8)
    {
        return $this->products()
            ->where('status', Constant::STATUS_ACTIVE)
            ->limit($limit)
            ->get();
    }
}
