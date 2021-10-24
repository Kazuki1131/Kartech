<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{SalesHistory, VisitedRecord, Photo, Survey, AnswerToTheSurvey};
use Auth;

final class CustomersShowDataService
{
    private $visitedRecords;
    private $surveys;
    private $surveyAnswers;
    private $salesHistories;

    //リクエストされた顧客の平均単価を取得
    private function getAvgSellingPriceOfRequestedCustomer(int $customerId): int
    {
        $totalSellingPrice = SalesHistory::where('customer_id', $customerId)->sum('price_sold');
        $this->visitedRecords = VisitedRecord::where('customer_id', $customerId)->orderBy('visited_at', 'desc')->paginate(5);

        if ($this->visitedRecords->count() !== 0) {
            return intval($totalSellingPrice / $this->visitedRecords->total());
        }

        return 0;
    }

    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    private function getImagePathsOfRequestedCustomer(): array
    {
        if ($this->visitedRecords->count()) {
            foreach ($this->visitedRecords->pluck('id') as $id){
                $ImagePaths[$id] = Photo::where('visited_id', $id)->pluck('image_path');
            }
            return $ImagePaths;
        }
        return [];
    }

    /**
     * @param int
     *
     * @return array
     */
    private function getSurveyOfRequestedCustomer(int $customerId): array
    {
        $this->surveys = Survey::where('shop_id', Auth::id())->get();
        $this->surveyAnswers = AnswerToTheSurvey::where('customer_id', $customerId)->get();

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

    private function getServicesSoldOnTheRequestedDate(int $customerId)
    {
        $this->salesHistories = SalesHistory::where('customer_id', $customerId)->get();
        if ($this->salesHistories->count()) {
            foreach ($this->visitedRecords->pluck('id') as $visitedRecordId) {
                $servicesSold[$visitedRecordId] = SalesHistory::select('visited_id', 'menu_name', 'price_sold')->where('visited_id', $visitedRecordId)->get();
            }
            return $servicesSold;
        }
        return [];
    }

    public function customersShowDataList($customer)
    {
        return [
            'customer' => $customer,
            'avgPurchasePrices' => $this->getAvgSellingPriceOfRequestedCustomer($customer->id),
            'numberOfVisits' => $this->visitedRecords->total(),
            'visitedRecords' => $this->visitedRecords,
            'imagePaths' => $this->getImagePathsOfRequestedCustomer(),
            'surveyList' => $this->getSurveyOfRequestedCustomer($customer->id),
            'servicesSoldList' => $this->getServicesSoldOnTheRequestedDate($customer->id)
        ];
    }
}
