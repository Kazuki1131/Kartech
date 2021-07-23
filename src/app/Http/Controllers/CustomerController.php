<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerDataService;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('customers.addition');
    }

    public function detail()
    {
        return view('customers.detail');
    }
}
