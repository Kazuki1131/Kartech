<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VisitedRecordRequest;
use App\Models\VisitedRecord;
use Auth;
use DB;

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
    public function create(Request $request)
    {
        return view('visited_records.create', ['customerId' => $request->customer_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\VisitedRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitedRecordRequest $request, VisitedRecord $visitedRecord)
    {
        $visitedRecord->user_id = Auth::id();
        $visitedRecord->fill($request->all());
        $visitedRecord->save();

        if ($request->hasFile('images')){
            foreach ($request->images as $image){
                DB::table('photos')->insert([[
                    'record_id' => $visitedRecord->id,
                    'image_path' => $image->store('public/uploads')
                    ]]);
            }
        }

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
