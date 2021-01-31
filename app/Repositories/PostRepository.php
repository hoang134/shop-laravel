<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\Post;

class PostRepository extends BaseRepository
{
    public function getModel()
    {
        return Post::class;
    }

    public function getByLink($link)
    {
        return $this->_model
            ->where('url_post', $link)
            ->where('status', Constant::STATUS_ACTIVE)
            ->first();
    }

    public function getNewPosts($limit = 5)
    {
        return $this->_model
            ->where('status', Constant::STATUS_ACTIVE)
            ->orderByDesc('id')
            ->limit($limit)
            ->get();
    }
}
