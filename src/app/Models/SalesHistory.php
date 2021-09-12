<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SalesHistory
 *
 * @property int $id
 * @property int $store_id
 * @property int $customer_id
 * @property int $record_id
 * @property int $menu_id
 * @property string $menu_name
 * @property int $price_sold
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\Menu $menu
 * @property-read \App\Models\Store $store
 * @property-read \App\Models\VisitedRecord $visited_record
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereMenuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory wherePriceSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SalesHistory extends Model
{
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function visited_record()
    {
        return $this->belongsTo(VisitedRecord::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
