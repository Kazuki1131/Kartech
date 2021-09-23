<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{CustomerStoreRequest, CustomerUpdateRequest, CustomersSearchRequest};
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

    public function store(CustomerStoreRequest $request, InsertIntoDatabaseService $insertService)
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

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->fill($request->all())->save();
        return redirect()->route('customers.edit', ['customer' => $customer])->with('flash_message', '顧客情報を更新しました。');
    }

    public function search(Request $request, CustomersIndexDataService $customer)
    {
        return view('customers.index', $customer->searchedCustomersDataList($request));
    }
}
