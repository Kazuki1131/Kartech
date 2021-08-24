<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnnotationTitle
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnnotationContent[] $annotation_content
 * @property-read int|null $annotation_content_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationTitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationTitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationTitle query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationTitle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationTitle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationTitle whereUserId($value)
 * @mixin \Eloquent
 */
class AnnotationTitle extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function annotation_content()
    {
        return $this->hasMany(AnnotationContent::class);
    }
}
