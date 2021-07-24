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
        if(!is_numeric($request->id)){
            return abort(404);
        }
        $detailData = $data->detailDataList($request->id);
        return view('customers.detail', $detailData);
    }
}
