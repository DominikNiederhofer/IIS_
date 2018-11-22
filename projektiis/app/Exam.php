<?php

namespace System;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function courses() {
        return $this->belongsTo(System\Course);
    }

    public function terms() {
        return $this->hasMany(System\Term);
    }
}
