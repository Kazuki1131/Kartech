<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerDataService;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('customers.addition');
    }

    public function detail(Request $request, CustomerDataService $data)
    {
        $detailData = $data->detailDataList($request);
        return view('customers.detail', $detailData);
    }
}
