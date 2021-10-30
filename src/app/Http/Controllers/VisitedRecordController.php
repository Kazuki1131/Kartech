<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{VisitedRecordStoreRequest, VisitedRecordUpdateRequest};
use App\Services\{InsertIntoDatabaseService, GetMenuListService};
use App\Models\{VisitedRecord, Photo};

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
    public function store(VisitedRecordStoreRequest $request, InsertIntoDatabaseService $insertService)
    {
        $insertService->visitedRecordCreate($request->validate());
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
    public function edit(VisitedRecord $visitedRecord)
    {
        return view('visited_records.edit', ['visitedRecord' => $visitedRecord]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VisitedRecordUpdateRequest $request)
    {
        $request->fill($request->validate())->save();
        return redirect()->route('customers.show',['customer' => $request->customer_id])
            ->with('flash_message', '来店記録を追加しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitedRecord $visitedRecord)
    {
        VisitedRecord::destroy($visitedRecord->id);
        Photo::where('visited_id', $visitedRecord->id)->delete();
        return redirect()->route('customers.show', $visitedRecord->customer_id)->with('flash_massage', '来店記録を削除しました。');
    }
}
