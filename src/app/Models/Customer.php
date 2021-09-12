<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property int $store_id
 * @property int $control_number
 * @property string|null $name
 * @property string $name_kana
 * @property int|null $gender
 * @property string|null $birthday
 * @property string $tel
 * @property string|null $email
 * @property string|null $memo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnswerToTheSurvey[] $answer_to_the_survey
 * @property-read int|null $answer_to_the_survey_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Photo[] $photo
 * @property-read int|null $photo_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesHistory[] $sales_history
 * @property-read int|null $sales_history_count
 * @property-read \App\Models\Store $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VisitedRecord[] $visited_record
 * @property-read int|null $visited_record_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    protected $fillable = ['store_id', 'control_number', 'name', 'name_kana', 'gender', 'birthday', 'tel', 'email', 'memo'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function visited_record()
    {
        return $this->hasMany(VisitedRecord::class);
    }

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function sales_history()
    {
        return $this->hasMany(SalesHistory::class);
    }

    public function answer_to_the_survey()
    {
        return $this->hasMany(AnswerToTheSurvey::class);
    }
}
