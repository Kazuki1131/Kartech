<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{CustomerRequest, CustomersSearchRequest};
use App\Services\{CustomersIndexDataService, CustomersCreateDataService, InsertIntoDatabaseService, CustomersShowDataService};
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(CustomersIndexDataService $service)
    {
        return view('customers.index', $service->allCustomersDataList());
    }

    public function create(CustomersCreateDataService $service)
    {
        return view('customers.create', $service->dataList());
    }

    public function store(CustomerRequest $request, InsertIntoDatabaseService $insertService)
    {
        $insertService->customers($request);
        return redirect()->route('customers.create')->with('flash_message', '新しくお客様が追加されました。');
    }

    public function show(Customer $customer, CustomersShowDataService $service)
    {
        return view('customers.show', $service->customersShowDataList($customer));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', ['customer' => $customer]);
    }

    public function search(Request $request, CustomersIndexDataService $customer)
    {
        if (!$request->keyword){
            return redirect()->route('customers.index')->with('flash_message', '条件を入力してから検索してください。');
        } elseif ($request->searchColumn === 'control_number' && !is_numeric($request->keyword)) {
            return redirect()->route('customers.index')->with('flash_message', '顧客番号で絞り込む場合は数字を入力してください。');
        } elseif ($request->searchColumn === 'name' && is_numeric($request->keyword)) {
            return redirect()->route('customers.index')->with('flash_message', '名前で絞り込む場合は数字で検索することはできません。');
        }
        return view('customers.index', $customer->searchedCustomersDataList($request));
    }
}
