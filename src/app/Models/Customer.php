<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property int $user_id
 * @property int $control_number
 * @property string|null $name
 * @property string $name_kana
 * @property int|null $gender
 * @property string|null $birthday
 * @property string|null $tel
 * @property string|null $email
 * @property string|null $memo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnnotationContent[] $annotation_content
 * @property-read int|null $annotation_content_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VisitedRecord[] $biz_record
 * @property-read int|null $biz_record_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionnaireAnswer[] $questionnaire_answer
 * @property-read int|null $questionnaire_answer_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereNameKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUserId($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    protected $fillable = ['user_id', 'control_number', 'name', 'name_kana', 'gender', 'birthday', 'tel', 'email', 'memo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function biz_record()
    {
        return $this->hasMany(VisitedRecord::class);
    }

    public function questionnaire_answer()
    {
        return $this->hasMany(QuestionnaireAnswer::class);
    }
}
