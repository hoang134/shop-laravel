<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\OrderRepository;

class HomeController extends Controller
{
    protected $orderRepository;

    public function __construct
    (
        OrderRepository $orderRepository
    )
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orderClose = $this->orderRepository->getOrderByStatus(Order::ORDER_CLOSE);
        $orderNew = $this->orderRepository->getOrderByStatus(Order::ORDER_NEW);
        $orderProcess = $this->orderRepository->getOrderByStatus(Order::ORDER_PROCESS);
        $orderSuccess = $this->orderRepository->getOrderByStatus(Order::ORDER_SUCCESS);
        return view('backend.modules.home.index', compact('orderClose', 'orderNew', 'orderProcess', 'orderSuccess'));
    }
}
