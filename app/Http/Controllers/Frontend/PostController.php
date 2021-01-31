<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use App\Repositories\ProductRepository;

class PostController extends Controller
{
    protected $postRepository;
    protected $productRepository;

    public function __construct(PostRepository $postRepository, ProductRepository $productRepository)
    {
        $this->postRepository = $postRepository;
        $this->productRepository = $productRepository;
    }

    public function index($link)
    {
        $post = $this->postRepository->getByLink($link);
        if (!$post) {
            abort(404);
        }
        $newPosts = $this->postRepository->getNewPosts();
        $newProducts = $this->productRepository->getNewProducts();
        return view('frontend.news.post', [
            'post' => $post,
            'newPosts' => $newPosts,
            'newProducts' => $newProducts,
        ]);
    }
}
