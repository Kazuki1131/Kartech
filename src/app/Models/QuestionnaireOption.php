<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

/**
 * App\Models\QuestionnaireOption
 *
 * @property int $id
 * @property int $questionnaire_id
 * @property string|null $option
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Questionnaire $questionnaire
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionnaireAnswer[] $questionnaire_answer
 * @property-read int|null $questionnaire_answer_count
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireOption whereOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireOption whereQuestionnaireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuestionnaireOption extends Model
{
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
