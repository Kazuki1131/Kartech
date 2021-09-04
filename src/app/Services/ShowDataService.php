<?php

declare(strict_types=1);

namespace App\Services;

final class ShowDataService
{
    private $customer;
    private $visitedRecord;
    private $questionnaire;

    public function __construct($customer, $visitedRecord, $questionnaire)
    {
        $this->customer = $customer;
        $this->visitedRecord = $visitedRecord;
        $this->questionnaire = $questionnaire;
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
            'answerList' => $this->questionnaire->getQuestionnaireAnswers($request)
        ];
    }
}
