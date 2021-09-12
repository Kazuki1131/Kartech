<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Survey
 *
 * @property int $id
 * @property int $store_id
 * @property string $question
 * @property int $type
 * @property int|null $order_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnswerToTheSurvey[] $answer_to_the_survey
 * @property-read int|null $answer_to_the_survey_count
 * @property-read \App\Models\Store $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SurveyOption[] $survey_option
 * @property-read int|null $survey_option_count
 * @method static \Illuminate\Database\Eloquent\Builder|Survey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Survey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Survey query()
 * @method static \Illuminate\Database\Eloquent\Builder|Survey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Survey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Survey whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Survey whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Survey whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Survey whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Survey whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Survey extends Model
{
    protected $fillable = ['store_id', 'question', 'type'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function survey_option()
    {
        return $this->hasMany(SurveyOption::class);
    }

    public function answer_to_the_survey()
    {
        return $this->hasMany(AnswerToTheSurvey::class);
    }
}
