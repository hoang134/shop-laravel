<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use App\Repositories\ProductRepository;

class PageController extends Controller
{
    protected $pageRepository;
    protected $productRepository;

    public function __construct(PageRepository $pageRepository, ProductRepository $productRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->productRepository = $productRepository;
    }

    public function index($link)
    {
        $page = $this->pageRepository->getByLink($link);
        if (!$page) {
            abort(404);
        }
        $newPages = $this->pageRepository->getNewPages();
        $newProducts = $this->productRepository->getNewProducts();
        return view('frontend.news.page', [
            'page' => $page,
            'newPages' => $newPages,
            'newProducts' => $newProducts,
        ]);
    }
}
