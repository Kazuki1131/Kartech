<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int $shop_id
 * @property string $name
 * @property string|null $description
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesHistory[] $sales_history
 * @property-read int|null $sales_history_count
 * @property-read \App\Models\Shop $shop
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    protected $fillable = ['shop_id', 'name', 'description', 'price'];
    protected $casts = [
        'id' => 'integer',
        'shop_id' => 'integer',
        'price' => 'integer',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function sales_history()
    {
        return $this->hasMany(SalesHistory::class);
    }
}
