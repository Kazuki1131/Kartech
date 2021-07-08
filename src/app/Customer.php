<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function biz_record()
    {
        return $this->hasMany(BizRecord::class);
    }

    public function annotation_content()
    {
        return $this->hasMany(AnnotationContent::class);
    }
}
