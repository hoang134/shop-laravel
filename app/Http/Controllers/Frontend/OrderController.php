<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Constant;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeQuantityRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\Order\AddCartRequest;
use App\Http\Requests\Order\CheckoutRequest;
use App\Http\Requests\Order\FastPurchaseRequest;
use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    protected $productRepository;
    protected $orderRepository;
    protected $customerRepository;
    protected $orderDetailRepository;

    public function __construct
    (
        ProductRepository $productRepository,
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository,
        OrderDetailRepository $orderDetailRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function cart()
    {
        $arrData = [];
        $totalAll = 0;
        if(request()->session()->has('cart')) {
            $arrData = request()->session()->get('cart');

            if (!empty($arrData)) {
                foreach ($arrData as $key => $item) {
                    $totalAll += $item['quantity'] * $item['product']->price;
                }
            }
        }

        return view('frontend.cart.cart', compact('arrData', 'totalAll'));
    }

    public function checkout()
    {
        $session = session()->get('cart');
        if (is_null($session)) {
            return redirect()->route('home');
        }
        return view('frontend.cart.checkout', [
            'session' => collect($session)
        ]);
    }

    public function doCheckout(CheckoutRequest $request)
    {
        DB::beginTransaction();
        try {
            $customerAttr = $request->only('name', 'address', 'phone');
            $customerAttr['email'] = $request->email ?? '';
            $customer = $this->customerRepository->create($customerAttr);

            $orderAttr = $request->only('content', 'payment_id');
            $orderAttr['customer_id'] = $customer->id;
            $orderAttr['code'] = Carbon::now()->timestamp . Str::random(10);
            $orderAttr['status'] = Constant::STATUS_NEW;
            $order = $this->orderRepository->create($orderAttr);

            $session = session()->get('cart');
            $session = collect($session);
            $ordersAttr = $session->map(function ($item) {
                $order['product_id'] = $item['product']->id;
                $order['price'] = $item['product']->price;
                $order['quantity'] = $item['quantity'];
                $order['total'] = $item['quantity'] * $item['product']->price;
                $order['status'] = Constant::STATUS_NEW;
                return $order;
            });
            $order->saveOrderDetails($ordersAttr);

            if ($request->email) {
                $dataEmail = [
                    'order' => $order
                ];
                $dataEmail = array_merge($dataEmail, $customerAttr);

                MailHelper::sendMailOrderInfo($request->email, $dataEmail);
            }

            DB::commit();
            request()->session()->forget('cart');
            return redirect()->route('orders.success-order', $order->code);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function successOrder($code)
    {
        $order = $this->orderRepository->getOrderByCode($code);
        return view('frontend.cart.success-order', compact('order'));
    }

    public function deleteProduct(DeleteProductRequest $request)
    {
        $id = $request->get('id');
        $totalAll = 0;
        $arrData = [];
        $msg = '';
        if(request()->session()->has('cart')) {
            $dataSession = request()->session()->get('cart');
            if (!empty($dataSession)) {
                foreach ($dataSession as $key => $item) {
                    if ($id == $item['product']->id) {
                        unset($dataSession[$key]);
                    } else {
                        $total = $item['product']->price * $item['quantity'];
                        $item['total'] = $total;
                        $arrData[] = $item;
                        $totalAll += $total;
                    }
                }
                session(['cart' => $arrData]);
            }
        }

        if (empty($arrData)) {
            request()->session()->forget('cart');
            $msg = __('labels.cart.empty_cart');
        }
        return response(['msg' => $msg, 'arrData' => $arrData, 'totalAll' => formatNumber($totalAll, 0)]);
    }


    public function changeQuantity(ChangeQuantityRequest $request) {
        $id = $request->get('id');
        $quantity = $request->get('quantity');
        $totalAll = 0;
        $arrData = [];
        $msg = '';
        if(request()->session()->has('cart')) {
            $dataSession = request()->session()->get('cart');
            if (!empty($dataSession)) {
                foreach ($dataSession as $key => $item) {


                    if ($id == $item['product']->id) {
                        $total = $item['product']->price * $quantity;
                        $item['quantity'] = $quantity;
                    } else {
                        $total = $item['product']->price * $item['quantity'];
                    }
                    $item['total'] = $total;

                    $arrData[] = $item;
                    $totalAll += $total;
                }

                session(['cart' => $arrData]);
            }
        }

        if (empty($arrData)) {
            $msg = __('labels.cart.empty_cart');
        }
        return response(['msg' => $msg, 'arrData' => $arrData, 'totalAll' => formatNumber($totalAll, 0)]);
    }

    public function addToCart(AddCartRequest $request)
    {
        $cartInfo = $request->only('product_id', 'quantity');
        $product = $this->productRepository->find($cartInfo['product_id']);

        $dataSession = [];
        if (!empty($product)) {
            if (request()->session()->has('cart')) {
                $dataSession = request()->session()->get('cart');
                $checkProduct = false;
                foreach ($dataSession as $key => $item) {
                    if ($item['product']->id == $cartInfo['product_id']) {
                        $item['quantity'] = $cartInfo['quantity'] + $item['quantity'];
                        $item['total'] = $item['quantity'] * $product->price;
                        $dataSession[$key] = $item;
                        $checkProduct = true;
                    }
                }
                if (!$checkProduct) {
                    unset($cartInfo['product_id']);
                    $cartInfo['product'] = $product;
                    $cartInfo['total'] = $cartInfo['quantity'] * $product->price;
                    array_push($dataSession, $cartInfo);
                }
            } else {
                unset($cartInfo['product_id']);
                $cartInfo['product'] = $product;
                $cartInfo['total'] = $cartInfo['quantity'] * $product->price;
                array_push($dataSession, $cartInfo);
            }

            request()->session()->forget('cart');
            session(['cart' => $dataSession]);
        }

        return response()->json([
            'message' => __('messages.general.added_to_cart'),
            'cartQuantity' => count($dataSession),
        ]);
    }

    public function orderFastPurchase(FastPurchaseRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->find($request->product_id);
            if (empty($product)) {
                return response(['msg' => __('messages.general.error'), 'status' => false]);
            }

            $customerAttr = $request->only('name', 'phone');
            $customerAttr['address'] = $request->address ?? '';
            $customerAttr['email'] = $request->email ?? '';
            $customer = $this->customerRepository->create($customerAttr);

            $orderAttr['customer_id'] = $customer->id;
            $orderAttr['code'] = Carbon::now()->timestamp . Str::random(10);
            $orderAttr['status'] = Constant::STATUS_NEW;
            $orderAttr['content'] = '';
            $orderAttr['payment_id'] = Order::PAYMENT_TRANSFER;
            $order = $this->orderRepository->create($orderAttr);

            $ordersAttr = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'total' => $request->quantity * $product->price,
                'status' => Constant::STATUS_NEW
            ];
            $this->orderDetailRepository->create($ordersAttr);

            if ($request->email) {
                $dataEmail = [
                    'order' => $order
                ];
                $dataEmail = array_merge($dataEmail, $customerAttr);

                MailHelper::sendMailOrderInfo($request->email, $dataEmail);
            }

            DB::commit();
            return response(['message' => __('labels.success-order.label'), 'status' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response(['message' => __('labels.success-order.order_fail'), 'status' => false]);
        }
    }
}
