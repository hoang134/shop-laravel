<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constant;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mockery\Exception;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $customerRepository;

    public function __construct
    (
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Order::class);
        $orders = $this->orderRepository->getAndPaginate(10);
        return view('backend.modules.orders.index', compact('orders'));
    }

    public function create()
    {
        $this->authorize('create', Order::class);
        return view('backend.modules.orders.add');
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Order::class);

        DB::beginTransaction();
        try {
            $customerId = $request->id;
            if (!$customerId) {
                $customerAttr = $request->only('name', 'address', 'phone', 'email');
                if (!$customerAttr['email']) {
                    $customerAttr['email'] = '';
                }
                if (!$customerAttr['address']) {
                    $customerAttr['address'] = '';
                }
                $customer = $this->customerRepository->create($customerAttr);
                $customerId = $customer->id;
            }

            $orderAttr = [
                'code' => Carbon::now()->timestamp . Str::random(10),
                'customer_id' => $customerId,
                'payment_id' => $request->payment_id,
                'status' => Constant::STATUS_NEW,
            ];
            $order = $this->orderRepository->create($orderAttr);

            $orderDetailsAttr = $request->products;
            foreach ($orderDetailsAttr as $key => $item) {
                $orderDetailsAttr[$key]['total'] = $item['price'] * $item['quantity'];
            }
            $order->saveOrderDetails($orderDetailsAttr);

            DB::commit();
            return redirect()->route('orders.index')->with('success', __('messages.general.success'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function edit($id)
    {
        $order = $this->orderRepository->find($id);
        if(!$order) {
            return redirect()->route('orders.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('update', $order);
        return view('backend.modules.orders.edit', compact('order'));
    }

    public function update(StoreRequest $request, $id)
    {
        $order = $this->orderRepository->find($id);
        if(!$order) {
            return redirect()->route('orders.index')->with('danger', __('messages.general.error'));
        }

        $this->authorize('update', $order);

        DB::beginTransaction();
        try {
            $customerId = $request->id;
            if (!$customerId) {
                $customerAttr = $request->only('name', 'address', 'phone', 'email');
                if (!$customerAttr['email']) {
                    $customerAttr['email'] = '';
                }
                if (!$customerAttr['address']) {
                    $customerAttr['address'] = '';
                }
                $customer = $this->customerRepository->create($customerAttr);
                $customerId = $customer->id;
            }

            $orderAttr = [
                'customer_id' => $customerId,
                'payment_id' => $request->payment_id,
            ];
            $order = $this->orderRepository->update($id, $orderAttr);

            $orderDetailsAttr = $request->products;
            foreach ($orderDetailsAttr as $key => $item) {
                $orderDetailsAttr[$key]['total'] = $item['price'] * $item['quantity'];
            }
            $order->orderDetails()->delete();
            $order->saveOrderDetails($orderDetailsAttr);

            DB::commit();
            return redirect()->route('orders.index')->with('success', __('messages.general.success'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);
        if(!$order) {
            return redirect()->route('orders.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('delete', $order);

        try {
            $this->orderRepository->delete($id);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function complete($id)
    {
        $order = $this->orderRepository->find($id);
        if(!$order) {
            return redirect()->route('orders.index')->with('danger', __('messages.general.not_found'));
        }

        $this->authorize('update', $order);

        try {
            $this->orderRepository->update($id, ['status' => Constant::STATUS_DONE]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function getDataOrder(Request $request)
    {
        $params = $request->only('code', 'name_customer', 'phone');
        $orders = $this->orderRepository->getDataOrder($params);

        return Datatables::of($orders)
            ->editColumn('name_customer', function ($row) {
                return $row->customer->name;
            })
            ->editColumn('phone', function ($row) {
                return $row->customer->phone;
            })
            ->editColumn('create', function ($row) {
                return formatDate($row->created_at, 'd-m-Y H:m:s');
            })
            ->editColumn('status', function ($row) {
                return getStatusOrder($row->status);
            })
            ->addColumn('action', function ($row) {
                $html = '<a href="' . route('orders.edit', $row->id) . '" class="btn btn-xs btn-success mg-t-5"><i class="fa fa-edit"></i></a>';
                if ($row->status != Constant::STATUS_DONE) {
                    $html .= '<a href="' . route('orders.complete', $row->id) . '" class="btn btn-xs btn-warning option-done-modal mg-l-5 mg-t-5"><i class="fa fa-check"></i></a>';
                }
                if ($row->status != Constant::STATUS_DELETED) {
                    $html .= '<a href="' . route('orders.delete', $row->id) . '" class="btn btn-xs btn-danger option-delete-modal mg-l-5 mg-t-5"><i class="fa fa-trash"></i></a>';
                }

                return $html;
            })
            ->rawColumns(['action', 'url_image'])
            ->make(true);
    }
}
