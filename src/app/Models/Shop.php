<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Shop
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customer
 * @property-read int|null $customer_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Menu[] $menu
 * @property-read int|null $menu_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Photo[] $photo
 * @property-read int|null $photo_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesHistory[] $sales_history
 * @property-read int|null $sales_history_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Survey[] $survey
 * @property-read int|null $survey_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VisitedRecord[] $visited_record
 * @property-read int|null $visited_record_count
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Shop extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function visited_record()
    {
        return $this->hasMany(VisitedRecord::class);
    }

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }

    public function sales_history()
    {
        return $this->hasMany(SalesHistory::class);
    }

    public function survey()
    {
        return $this->hasMany(survey::class);
    }
}
