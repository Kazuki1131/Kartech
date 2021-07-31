<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BizRecord
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
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BizRecord whereVisitedAt($value)
 * @mixin \Eloquent
 */
class BizRecord extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
