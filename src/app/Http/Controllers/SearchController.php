<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerDataService;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CustomerDataService $customer)
    {
        return view('search', $customer->customerDataLists());
    }
}
