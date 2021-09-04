<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QuestionnaireAnswer
 *
 * @property int $id
 * @property int $customer_id
 * @property int $option_id
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\QuestionnaireOption $questionnaire_option
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireAnswer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireAnswer whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireAnswer whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireAnswer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuestionnaireAnswer extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
