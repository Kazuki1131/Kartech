<?php

declare(strict_types=1);

namespace App\Services;

use DB;
use Auth;
use App\Models\{Customer, Questionnaire, VisitedRecord};
use App\Services\CustomerDataService;

final class InsertIntoDatabaseService
{
    public function customers($request)
    {
        $customer = new Customer;
        $service = new CustomerDataService;

        $customer->user_id = Auth::id();
        $customer->control_number = $service->getControlNumberToSet();
        $customer->fill($request->all());
        $customer->save();
        if (isset($request->answer_text)) {
            foreach ($request->answer_text as $id => $answer) {
                $answerData[] = [
                    'questionnaire_id' => $id,
                    'customer_id' => $customer->id,
                    'answer' => $answer
                ];
            }
        }
        if (isset($request->answer_select)) {
            foreach ($request->answer_select as $id => $answer) {
                $answerData[] = [
                    'questionnaire_id' => $id,
                    'customer_id' => $customer->id,
                    'answer' => $answer
                ];
            }
        }
        if (isset($request->answer_check)) {
            foreach ($request->answer_check as $id => $answer) {
                $answerData[] = [
                    'questionnaire_id' => $id,
                    'customer_id' => $customer->id,
                    'answer' => implode(' , ', $answer)
                ];
            }
        }
        if (isset($answerData)) {
            DB::table('questionnaire_answers')->insert($answerData);
        }
    }

    public function questionnaires($request)
    {
        $questionnaire = new Questionnaire;

        $questionnaire->user_id = Auth::id();
        $questionnaire->fill($request->all());
        $questionnaire->save();
        if ($request->type === '0'){
            return redirect()->route('questionnaires.create')->with('flash_message', '新しいアンケートを追加しました。');
        } elseif ($request->type === '1') {
            foreach ($request->singleAnswers as $singleAnswer) {
                $insertData[] = [
                    'questionnaire_id' => $questionnaire->id,
                    'option' => $singleAnswer
                ];
            }
            DB::table('questionnaire_options')->insert($insertData);
        } elseif ($request->type === '2') {
            foreach ($request->multipleAnswers as $multipleAnswer) {
                $insertData[] = [
                    'questionnaire_id' => $questionnaire->id,
                    'option' => $multipleAnswer
                ];
            }
            DB::table('questionnaire_options')->insert($insertData);
        } else {
            return abort(404);
        }
    }

    public function visitedRecords($request)
    {
        $visitedRecord = New VisitedRecord;

        $visitedRecord->user_id = Auth::id();
        $visitedRecord->fill($request->all());
        $visitedRecord->save();

        if ($request->hasFile('images')){
            foreach ($request->images as $image){
                $insertData[] = [
                    'record_id' => $visitedRecord->id,
                    'image_path' => $image->store('public/uploads')
                ];
            }
            DB::table('photos')->insert($insertData);
        }
    }
}