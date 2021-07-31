<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnnotationContent
 *
 * @property int $id
 * @property int $customer_id
 * @property int $annotation_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AnnotationTitle $annotation_title
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationContent whereAnnotationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationContent whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnnotationContent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AnnotationContent extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function annotation_title()
    {
        return $this->belongsTo(AnnotationTitle::class);
    }
}
