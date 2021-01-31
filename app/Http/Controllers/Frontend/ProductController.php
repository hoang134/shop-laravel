<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index($link)
    {
        $product = $this->productRepository->getByLink($link);
        if (!$product) {
            abort(404);
        }

        $otherProducts = $product->category->randomProducts(5);
        return view('frontend.product.product', [
            'product' => $product,
            'otherProducts' => $otherProducts
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

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

        $products = $this->productRepository->searchByName($keyword, $sort, 12);

        return view('frontend.product.search', compact('products'));
    }
}
