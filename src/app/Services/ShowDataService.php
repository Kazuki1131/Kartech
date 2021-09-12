<?php

declare(strict_types=1);

namespace App\Services;

final class ShowDataService
{
    private $customer;
    private $visitedRecord;
    private $survey;

    public function __construct($customer, $visitedRecord, $survey)
    {
        $this->customer = $customer;
        $this->visitedRecord = $visitedRecord;
        $this->survey = $survey;
    }

    public function customer(int $request)
    {
        return [
            'customer' => $this->customer->getOrderedCustomer($request),
            'lastVisitDate' => $this->customer->requestVisitedAts()[0] ?? null,
            'visitedTimes' => count($this->customer->requestVisitedAts()),
            'avgPurchasePrices' => $this->customer->requestAvgPurchasePrice($request),
            'visitedRecords' => $this->visitedRecord->getVisitedRecords($request),
            'imagePaths' => $this->visitedRecord->getImagePaths(),
            'surveyList' => $this->survey->getRequestedCustomerSurvey($request)
        ];
    }
}
