<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constant;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Helpers\HelpersFun;
use App\Models\Image;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Product::class);
        $products = $this->productRepository->getAndPaginate(10);
        return view('backend.modules.products.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);
        $categories = $this->categoryRepository->filter([['parent_id', '=', Constant::ROOT_CATEGORY], ['status', '=', Constant::STATUS_ACTIVE]]);
        return view('backend.modules.products.add', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->authorize('create', Product::class);
            $data = $request->except('_token', 'url_image');
            $data['url_product'] = saveUrl($request->name);

            $imageAttr['sort_no'] = 0;
            if($request->hasFile('url_image')) {
                $image = HelpersFun::getNameImage($request->file('url_image'), 'products', $data['url_product']);
                $imageAttr['url'] = $image;
            }

            $product = $this->productRepository->create($data);
            $product->images()->create($imageAttr);

            $addImages = $request->product_add_images ?? [];
            $imageData = [];
            foreach ($addImages as $addImg) {
                $imageData[] = [
                    'url' => $addImg
                ];
            }

            $product->images()->createMany($imageData);

            $deleteImages = $request->product_delete_images ?? [];
            foreach ($deleteImages as $deleteImg) {
                $productImage = $product->images()->where('url', $deleteImg)->first();

                if ($productImage) {
                    $productImage->delete();
                }

                HelpersFun::deleteImage($deleteImg);
            }

            $sortNos = $request->sort_no_images ?? [];
            foreach ($sortNos as $sortNo) {
                list($fileName, $sortVal) = explode('//', $sortNo);
                $productImage = $product->images()
                    ->where('url', $fileName)->first();
                $productImage->sort_no = $sortVal;
                $productImage->save();
            }

            DB::commit();
            return redirect()->route('products.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        if(!$product) {
            return redirect()->route('products.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('update', $product);
        $categories = $this->categoryRepository->filter([['parent_id', '=', Constant::ROOT_CATEGORY], ['status', '=', Constant::STATUS_ACTIVE]]);
        return view('backend.modules.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = $this->productRepository->find($id);
        if(!$product) {
            return redirect()->route('products.index')->with('danger', __('messages.general.error'));
        }

        $this->authorize('update', $product);

        DB::beginTransaction();
        try {
            $data = $request->only('name', 'category_id', 'description', 'content', 'price', 'quantity', 'status');
            $data['url_product'] = saveUrl($request->name);
            if($request->hasFile('url_image')) {
                HelpersFun::deleteImage($product->url_image);
                $imageUrl = HelpersFun::getNameImage($request->file('url_image'), 'products', $data['url_product']);
                $mainImage = $product->images()->first();
                if ($mainImage) {
                    $mainImage->url = $imageUrl;
                } else {
                    $mainImage = new Image();
                    $mainImage->product_id = $product->id;
                    $mainImage->url = $imageUrl;
                    $mainImage->sort_no = 0;
                }
                $mainImage->save();
            }

            $product->update($data);

            $addImages = $request->product_add_images ?? [];
            $imageData = [];
            foreach ($addImages as $addImg) {
                $imageData[] = [
                    'url' => $addImg
                ];
            }

            $product->images()->createMany($imageData);

            $deleteImages = $request->product_delete_images ?? [];
            foreach ($deleteImages as $deleteImg) {
                $productImage = $product->images()->where('url', $deleteImg)->first();

                if ($productImage) {
                    $productImage->delete();
                }

                HelpersFun::deleteImage($deleteImg);
            }

            $sortNos = $request->sort_no_images ?? [];
            foreach ($sortNos as $sortNo) {
                list($fileName, $sortVal) = explode('//', $sortNo);
                $productImage = $product->images()
                    ->where('url', $fileName)->first();
                $productImage->sort_no = $sortVal;
                $productImage->save();
            }
            DB::commit();
            return redirect()->route('products.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function destroy($id)
    {
        $product = $this->productRepository->find($id);
        if(!$product) {
            return redirect()->route('products.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('delete', $product);

        try {
            $this->productRepository->update($id, ['status' => Constant::STATUS_DELETED]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function restore($id)
    {
        $this->authorize('restore', Product::class);
        $product = $this->productRepository->find($id);
        if(!$product) {
            return redirect()->route('products.index')->with('danger', __('messages.general.not_found'));
        }

        try {
            $this->productRepository->update($id, ['status' => Constant::STATUS_ACTIVE]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->term;
        $products = $this->productRepository->searchByName($keyword);
        $products = $products->getCollection();
        return response()->json($products);
    }

    public function addImage(ImageRequest $request)
    {
        $images = $request->file('product_image');

        $allowExtensions = ['jpg', 'jpeg', 'png'];

        $error = false;
        $message = '';
        $paths = [];
        $files = [];
        if (count($images) > 0) {
            foreach ($images as $image) {
                $mimeType = $image->getMimeType();
                if (0 !== strpos($mimeType, 'image')) {
                    $error = true;
                    $message = 'Không hỗ trợ kiểu file';
                    break;
                }

                $extension = $image->getClientOriginalExtension();
                if (!in_array(strtolower($extension), $allowExtensions)) {
                    $error = true;
                    $message = 'Không hỗ trợ kiểu file hình ảnh';
                    break;
                }

                $fileName = saveUrl($image->getClientOriginalName());
                $imagePath = HelpersFun::getNameImage($image, 'images', $fileName);
                $files[] = $fileName;
                $paths[] = $imagePath;
            }
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
            'files' => $files,
            'paths' => $paths
        ]);
    }

    public function getDataProduct(Request $request)
    {
        $productName = $request->name;
        $products = $this->productRepository->getDataProductByName($productName);

        return Datatables::of($products)
            ->editColumn('url_image', function ($row) {
                $image = $row->url_image ? $row->url_image : '/frontend/img/image_default.jpg';
                return '<img src="' . $image . '" />';
            })
            ->editColumn('status', function ($row) {
                return getStatus($row->status);
            })
            ->addColumn('action', function ($row) {
                $html = '<a href="' . route('products.edit', $row->id) . '" class="btn btn-xs btn-success mg-t-5"><i class="fa fa-edit"></i></a>';
                if ($row->status != Constant::STATUS_DELETED) {
                    $html .= '<a href="' . route('products.delete', $row->id) . '" class="btn btn-xs btn-danger option-delete-modal mg-l-5 mg-t-5" ><i class="fa fa-trash" ></i ></a>';
                }
                if ($row->status == Constant::STATUS_DELETED) {
                    $html .= '<a href="' . route('products.restore', $row->id) . '" class="btn btn-xs btn-danger option-restore-modal mg-l-5 mg-t-5"><i class="fa fa-refresh"></i></a>';
                }

                return $html;
            })
            ->rawColumns(['action', 'url_image'])
            ->make(true);
    }
}
