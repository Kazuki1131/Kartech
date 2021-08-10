<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VisitedRecord
 *
 * @property int $id
 * @property int $customer_id
 * @property int $menu_id
 * @property string|null $note
 * @property string|null $image
 * @property string|null $visited_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereVisitedAt($value)
 * @mixin \Eloquent
 */
class VisitedRecord extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
