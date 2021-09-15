<?php

declare(strict_types=1);

namespace App\Services;

use DB;
use Auth;
use App\Models\{Customer, Survey, VisitedRecord, Menu};
use App\Services\CustomerDataService;

final class InsertIntoDatabaseService
{
    private $visitedRecordId;

    public function customers($request)
    {
        $customer = new Customer;
        $service = new CustomerDataService;

        $customer->shop_id = Auth::id();
        $customer->control_number = $service->getControlNumberToSet();
        $customer->fill($request->all());
        $customer->save();
        if (isset($request->answer_text)) {
            foreach ($request->answer_text as $id => $answer) {
                $answerData[] = [
                    'survey_id' => $id,
                    'customer_id' => $customer->id,
                    'answer' => $answer
                ];
            }
        }
        if (isset($request->answer_select)) {
            foreach ($request->answer_select as $id => $answer) {
                $answerData[] = [
                    'survey_id' => $id,
                    'customer_id' => $customer->id,
                    'answer' => $answer
                ];
            }
        }
        if (isset($request->answer_check)) {
            foreach ($request->answer_check as $id => $answer) {
                $answerData[] = [
                    'survey_id' => $id,
                    'customer_id' => $customer->id,
                    'answer' => implode(' , ', $answer)
                ];
            }
        }
        if (isset($answerData)) {
            DB::table('answer_to_the_surveys')->insert($answerData);
        }
    }

    public function surveys($request)
    {
        $survey = new Survey;
        $survey->shop_id = Auth::id();
        $survey->fill($request->all());
        $survey->save();
        if ($request->type === '0'){
            return redirect()->route('surveys.create')->with('flash_message', '新しいアンケートを追加しました。');
        } elseif ($request->type === '1') {
            foreach ($request->singleAnswers as $singleAnswer) {
                $insertData[] = [
                    'survey_id' => $survey->id,
                    'option' => $singleAnswer
                ];
            }
            DB::table('survey_options')->insert($insertData);
        } elseif ($request->type === '2') {
            foreach ($request->multipleAnswers as $multipleAnswer) {
                $insertData[] = [
                    'survey_id' => $survey->id,
                    'option' => $multipleAnswer
                ];
            }
            DB::table('survey_options')->insert($insertData);
        } else {
            return abort(404);
        }
    }

    public function menus($request)
    {
        $menu = new Menu;
        $menu->shop_id = Auth::id();
        $menu->fill($request->all());
        $menu->save();
    }

    private function visitedRecords($request)
    {
        $visitedRecord = new VisitedRecord;
        $visitedRecord->shop_id = Auth::id();
        $visitedRecord->fill($request->all());
        $visitedRecord->save();

        $this->visitedRecordId = $visitedRecord->id;
    }

    private function photos($request, $visitedRecordId)
    {
        if ($request->hasFile('images')){
            foreach ($request->images as $image){
                $insertData[] = [
                    'shop_id' => Auth::id(),
                    'customer_id' => $request->customer_id,
                    'visited_id' => $visitedRecordId,
                    'image_path' => $image->store('images', 's3', 'public')
                ];
            }
            DB::table('photos')->insert($insertData);
        }
    }

    private function salesHistories($request, $visitedRecordId)
    {
        $menus = Menu::where('shop_id', Auth::id())->get();
        $insertData = [];
        foreach ($request->menus as $menuId) {
            foreach ($menus as $menu) {
                if(intval($menuId) === $menu->id){
                    $insertData[] = [
                        'shop_id' => Auth::id(),
                        'customer_id' => $request->customer_id,
                        'visited_id' => $visitedRecordId,
                        'menu_id' => $menuId,
                        'menu_name' => $menu->name,
                        'price_sold' => $menu->price
                    ];
                }
            }
        }
        DB::table('sales_histories')->insert($insertData);
    }

    public function visitedRecordCreate($request)
    {
        $this->visitedRecords($request);
        $this->photos($request, $this->visitedRecordId);
        $this->salesHistories($request, $this->visitedRecordId);
    }
}
