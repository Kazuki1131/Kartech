<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{Survey, SurveyOption, AnswerToTheSurvey};

final class SurveyDataService
{
    /**
     * @var int
     */
    private $authId;

    /**
     * @var \Illuminate\Database\Eloquent\Collection
     */
    private $surveys;

    public function __construct($authId)
    {
        $this->authId = $authId;
        $this->surveys = Survey::where('shop_id', $this->authId)->get();
    }

    /**
     * @return Illuminate\Database\Eloquent\Collection
     */

    private function getSurveyOptions(): array
    {
        $selectionTypeIsSingle = 1;
        $selectionTypeIsMultiple = 2;

        if (
            Survey::where('shop_id', $this->authId)
                ->where(function($query) use($selectionTypeIsSingle, $selectionTypeIsMultiple) {
                    $query->where('type', $selectionTypeIsSingle)
                        ->orWhere('type', $selectionTypeIsMultiple);
                })->exists()
        ) {
            $selectionTypePrimaryId = Survey::where('shop_id', $this->authId)
            ->where(function($query) use($selectionTypeIsSingle, $selectionTypeIsMultiple) {
                $query->where('type', $selectionTypeIsSingle)
                ->orWhere('type', $selectionTypeIsMultiple);
            })->pluck('id');

            foreach ($selectionTypePrimaryId as $id){
                $surveyOptions[$id] = SurveyOption::where('survey_id', $id)->pluck('option');
            }
            return $surveyOptions;
        }
        return [];
    }

    /**
     * @param int
     *
     * @return array
     */
    public function getRequestedCustomerSurvey(int $customerId): array
    {
        if (AnswerToTheSurvey::where('customer_id', $customerId)->exists()) {
            $answers = AnswerToTheSurvey::where('customer_id', $customerId)->get();
            foreach ($this->surveys as $survey) {
                foreach ($answers as $answer) {
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

    /**
     * @return array
     */
    public function surveyDataList(): array
    {
        if (Survey::where('shop_id', $this->authId)->exists()) {
            foreach ($this->surveys as $survey) {
                $surveyData[$survey->id] = [
                    'question' => $survey->question,
                    'type' => $survey->type,
                    'options' =>[]
                ];
                foreach ($this->getSurveyOptions() as $id => $option) {
                    if ($survey->id === $id){
                        $surveyData[$id]['options'] = $option;
                    }
                }
            }
            return ['surveyList' => $surveyData];
        }
        return [];
    }
}
