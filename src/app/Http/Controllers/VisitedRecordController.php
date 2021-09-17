<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VisitedRecordRequest;
use App\Services\{InsertIntoDatabaseService, GetMenuListService};

class VisitedRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, GetMenuListService $menus)
    {
        return view('visited_records.create', ['customerId' => $request->customer_id, 'menus' => $menus->getAllMenusInTheShop()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\VisitedRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitedRecordRequest $request, InsertIntoDatabaseService $insertService)
    {
        $insertService->visitedRecordCreate($request);
        return redirect()->route('customers.show',['customer' => $request->customer_id])
            ->with('flash_message', '来店記録を追加しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
