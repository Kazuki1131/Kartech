<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Services\{CustomerDataService, VisitedRecordDataService};
use App\Models\Customer;
use Auth;

class CustomerController extends Controller
{
    private $customerDataService;

    public function __construct(CustomerDataService $customerDataService)
    {
        $this->customerDataService = $customerDataService;
    }

    public function index()
    {
        return view('customers.index', $this->customerDataService->indexDataList());
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

    public function show(Request $request, VisitedRecordDataService $record)
    {
        if(!is_numeric($request->customer)){
            return abort(404);
        }
        return view('customers.show',
            $this->customerDataService->showDataList($request->customer),
            $record->showDataList($request->customer),
        );
    }
}
