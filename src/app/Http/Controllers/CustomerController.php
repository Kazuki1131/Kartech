<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Services\CustomerDataService;
use App\Models\Customer;
use Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CustomerDataService $customer)
    {
        return view('customers.index', $customer->customerDataLists());
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(CustomerRequest $request, Customer $customer)
    {
        $customer->user_id = Auth::id();
        $customer->fill($request->all());
        $customer->save();
        return redirect()->route('customers.index')->with('flash_message', '新しい顧客を追加しました。');
    }

    public function show(Request $request, CustomerDataService $data)
    {
        if(!is_numeric($request->customer)){
            return abort(404);
        }
        $showData = $data->showDataList($request->customer);
        return view('customers.show', $showData);
    }
}
