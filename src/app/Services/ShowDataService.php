<?php

declare(strict_types=1);

namespace App\Services;

final class ShowDataService
{
    private $customer;
    private $visitedRecord;
    private $survey;
    private $salesHistory;

    public function __construct($customer, $visitedRecord, $survey, $salesHistory)
    {
        $this->customer = $customer;
        $this->visitedRecord = $visitedRecord;
        $this->survey = $survey;
        $this->salesHistory = $salesHistory;
    }

    public function customer(int $request)
    {
        return [
            'customer' => $this->customer->getAllColumnsOfRequestedCustomer($request),
            'avgPurchasePrices' => $this->customer->getAvgSellingPriceOfRequestedCustomer($request),
            'visitedRecords' => $this->visitedRecord->getVisitedRecords($request),
            'imagePaths' => $this->visitedRecord->getImagePaths(),
            'surveyList' => $this->survey->getRequestedCustomerSurvey($request),
            'servicesSoldList' => $this->salesHistory->getServicesSoldOnTheRequestedDate($request)
        ];
    }
}
