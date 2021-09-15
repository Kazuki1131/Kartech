<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VisitedRecord
 *
 * @property int $id
 * @property int $shop_id
 * @property int $customer_id
 * @property string|null $memo
 * @property string|null $visited_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Photo[] $photo
 * @property-read int|null $photo_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesHistory[] $sales_history
 * @property-read int|null $sales_history_count
 * @property-read \App\Models\Shop $shop
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitedRecord whereVisitedAt($value)
 * @mixin \Eloquent
 */
class VisitedRecord extends Model
{
    protected $fillable = ['shop_id', 'customer_id', 'memo', 'image', 'visited_at'];
    protected $casts = [
        'id' => 'integer',
        'shop_id' => 'integer',
        'customer_id' => 'integer',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function sales_history()
    {
        return $this->hasMany(SalesHistory::class);
    }
}
