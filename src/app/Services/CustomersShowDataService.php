<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{Customer, SalesHistory, VisitedRecord, Photo, Survey, AnswerToTheSurvey};
use Auth;

final class CustomersShowDataService
{
    private $customer;
    private $visitedRecords;
    private $surveys;
    private $surveyAnswers;
    private $salesHistories;

    //リクエストされた顧客だけ取得
    private function getAllColumnsOfRequestedCustomer(int $request)
    {
        return $this->customer = Customer::where([
                ['shop_id', Auth::id()],
                ['id', $request],
            ])->first();
    }

    //リクエストされた顧客の平均単価を取得
    private function getAvgSellingPriceOfRequestedCustomer(int $request): int
    {
        if ($this->customer->count()) {
            $totalSellingPrice = SalesHistory::where('customer_id', $request)->sum('price_sold');
            $this->visitedRecords = VisitedRecord::where('customer_id', $request)->get();
            if ($this->visitedRecords->count() !== 0) {
                return $totalSellingPrice / $this->visitedRecords->count();
            }
        }
        return 0;
    }

    /**
     * @property int $request
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    private function getVisitedRecordsOfRequestedCustomer()
    {
        if ($this->visitedRecords->count() !== 0) {
            return $this->visitedRecords->orderBy('visited_at', 'desc')->paginate(5);
        }
        return null;
    }

    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    private function getImagePathsOfRequestedCustomer(): array
    {
        if ($this->visitedRecords->count()) {
            foreach ($this->visitedRecord->pluck('id') as $id){
                $ImagePaths[$id] = Photo::where('visited_id', $id)->pluck('image_path');
            }
            return $ImagePaths;
        }
    }

    /**
     * @param int
     *
     * @return array
     */
    private function getSurveyOfRequestedCustomer(int $request): array
    {
        $this->surveys = Survey::where('shop_id', Auth::id())->get();
        $this->surveyAnswers = AnswerToTheSurvey::where('customer_id', $request)->get();

        if ($this->surveyAnswers->count()) {
            foreach ($this->surveys as $survey) {
                foreach ($this->surveyAnswers as $answer) {
                    if ($survey->id === $answer->survey_id) {
                        $surveyList[] = [
                            'question' => $survey->question,
                            'answer' => $answer->answer
                        ];
                    }
                }
            }
            return $surveyList;
        }
        return [];
    }

    private function getServicesSoldOnTheRequestedDate(int $request)
    {
        $this->salesHistories = SalesHistory::where('customer_id', $request)->get();
        if ($this->salesHistories->count()) {
            foreach ($this->visitedRecords->pluck('id') as $visitedRecordId) {
                $servicesSold[$visitedRecordId] = SalesHistory::select('visited_id', 'menu_name', 'price_sold')->where('visited_id', $visitedRecordId)->get();
            }
            return $servicesSold;
        }
        return [];
    }

    public function customersShowDataList(int $request)
    {
        return [
            'customer' => $this->getAllColumnsOfRequestedCustomer($request),
            'avgPurchasePrices' => $this->getAvgSellingPriceOfRequestedCustomer($request),
            'visitedRecords' => $this->getVisitedRecordsOfRequestedCustomer(),
            'imagePaths' => $this->getImagePathsOfRequestedCustomer(),
            'surveyList' => $this->getSurveyOfRequestedCustomer($request),
            'servicesSoldList' => $this->getServicesSoldOnTheRequestedDate($request)
        ];
    }
}
