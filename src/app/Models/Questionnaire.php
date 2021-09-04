<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Questionnaire
 *
 * @property int $id
 * @property int $user_id
 * @property string $item
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionnaireOption[] $questionnaire_option
 * @property-read int|null $questionnaire_option_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire query()
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereUserId($value)
 * @mixin \Eloquent
 */
class Questionnaire extends Model
{
    protected $fillable = ['user_id', 'item', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionnaire_option()
    {
        return $this->hasMany(QuestionnaireOption::class);
    }

    public function questionnaire_answer()
    {
        return $this->hasMany(QuestionnaireAnswer::class);
    }
}
