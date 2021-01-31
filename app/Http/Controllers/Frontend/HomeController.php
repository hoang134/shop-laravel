<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Helpers\MailHelper;
use App\Helpers\Constant;
use App\Repositories\BannerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\ProductRepository;

class HomeController extends Controller
{
    protected $bannerRepository;
    protected $categoryRepository;
    protected $productRepository;
    protected $postRepository;

    public function __construct(BannerRepository $bannerRepository, CategoryRepository $categoryRepository, PostRepository $postRepository, ProductRepository $productRepository)
    {
        $this->bannerRepository = $bannerRepository;
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $banners = $this->bannerRepository->getNewBanners(2, Constant::POSITION_BANNER);
        $slides = $this->bannerRepository->getNewBanners(3, Constant::POSITION_SLIDER);
        $posts = $this->postRepository->getNewPosts(4);
        $newProducts = $this->productRepository->getNewProducts(5);
        $categories = $this->categoryRepository->getHomeCategories();
        return view('frontend.home.index', compact('banners', 'slides', 'posts', 'newProducts', 'categories'));
    }

    public function sendContactUs(ContactUsRequest $request)
    {
        if($request->ajax()) {
            $data = $request->except('_token');
            try {
                MailHelper::sendMailContact($data);

                return response()->json([
                    'status' => 200,
                    'message' => '成功メールを完全に送信'
                ]);

            } catch (\Exception $exception) {
                return response()->json([
                    'status' => 500,
                    'message' => 'メール送信エラー'
                ]);
            }
        }

    }
}
