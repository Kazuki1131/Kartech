<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{Survey, SurveyOption};
use Auth;

final class GetSurveyListService
{
    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    private function getSurveyOptions(): array
    {
        $selectionTypeIsSingle = 1;
        $selectionTypeIsMultiple = 2;

        $selectionTypePrimaryId = Survey::where('shop_id', Auth::id())
            ->where(function($query) use($selectionTypeIsSingle, $selectionTypeIsMultiple) {
                $query->where('type', $selectionTypeIsSingle)
                ->orWhere('type', $selectionTypeIsMultiple);
            })->pluck('id');

        if ($selectionTypePrimaryId->count()) {
            foreach ($selectionTypePrimaryId as $id){
                $surveyOptions[$id] = SurveyOption::where('survey_id', $id)->pluck('option');
            }
            return $surveyOptions;
        }
        return [];
    }

    /**
     * @return array
     */
    public function surveyDataList(): array
    {
        $surveys = Survey::where('shop_id', Auth::id())->get();

        if ($surveys->count()) {
            foreach ($surveys as $survey) {
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
