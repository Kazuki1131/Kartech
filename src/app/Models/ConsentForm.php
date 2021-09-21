<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ConsentForm
 *
 * @property int $id
 * @property int $shop_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop $shop
 * @method static \Illuminate\Database\Eloquent\Builder|ConsentForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsentForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsentForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsentForm whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsentForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsentForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsentForm whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsentForm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ConsentForm extends Model
{
    protected $fillable = ['shop_id', 'content'];
    protected $casts = [
        'id' => 'integer',
        'shop_id' => 'integer',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
