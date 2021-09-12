<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

/**
 * App\Models\SurveyOption
 *
 * @property int $id
 * @property int $survey_id
 * @property string|null $option
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Survey $survey
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyOption whereOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyOption whereSurveyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SurveyOption extends Model
{
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
