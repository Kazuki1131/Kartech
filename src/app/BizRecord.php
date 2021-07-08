<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BizRecord extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
