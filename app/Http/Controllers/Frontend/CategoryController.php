<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request, $link)
    {
        $category = $this->categoryRepository->getByLink($link);
        if (!$category) {
            abort(404);
        }

        $sort = $request->sort;
        switch ($sort) {
            case 'asc':
                $sort = 'ASC';
                break;
            case 'desc':
                $sort = 'DESC';
                break;
            default:
                $sort = null;
                break;
        }

        $products = $category->productsSort($sort);
        return view('frontend.product.category', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
