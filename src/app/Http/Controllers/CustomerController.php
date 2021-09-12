<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Services\{CustomerDataService, SurveyDataService, InsertIntoDatabaseService, ShowDataService};

class CustomerController extends Controller
{
    public function index(CustomerDataService $customer)
    {
        return view('customers.index', $customer->indexDataList());
    }

    public function create(SurveyDataService $survey)
    {
        return view('customers.create', $survey->surveyDataList());
    }

    public function store(CustomerRequest $request, InsertIntoDatabaseService $insertService)
    {
        $insertService->customers($request);
        return redirect()->route('customers.index')->with('flash_message', '新しい顧客を追加しました。');
    }

    public function show(Request $request, ShowDataService $showDataList)
    {
        if(!is_numeric($request->customer)){
            return abort(404);
        }
        return view('customers.show', $showDataList->customer($request->customer));
    }
}
