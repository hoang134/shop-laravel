<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function search(Request $request)
    {
        $keyword = $request->term;
        $customers = $this->customerRepository->searchByName($keyword);
        $customers = $customers->getCollection();
        return response()->json($customers);
    }
}
