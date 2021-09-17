<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Services\{CustomersIndexDataService, GetSurveyListService, InsertIntoDatabaseService, CustomersShowDataService};

class CustomerController extends Controller
{
    public function index(CustomersIndexDataService $service)
    {
        return view('customers.index', $service->allCustomersDataList());
    }

    public function create(GetSurveyListService $service)
    {
        return view('customers.create', $service->surveyDataList());
    }

    public function store(CustomerRequest $request, InsertIntoDatabaseService $insertService)
    {
        $insertService->customers($request);
        return redirect()->route('customers.index')->with('flash_message', '新しい顧客を追加しました。');
    }

    public function show(Request $request, CustomersShowDataService $service)
    {
        if(!is_numeric($request->customer)){
            return abort(404);
        }
        return view('customers.show', $service->customersShowDataList($request->customer));
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
