<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnswerToTheSurvey
 *
 * @property int $id
 * @property int $customer_id
 * @property int $survey_id
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\Survey $survey
 * @method static \Illuminate\Database\Eloquent\Builder|AnswerToTheSurvey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnswerToTheSurvey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnswerToTheSurvey query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnswerToTheSurvey whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnswerToTheSurvey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnswerToTheSurvey whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnswerToTheSurvey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnswerToTheSurvey whereSurveyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnswerToTheSurvey whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AnswerToTheSurvey extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
