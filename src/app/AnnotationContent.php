<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
