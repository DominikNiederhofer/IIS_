<?php

namespace System;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public function users() {
        return $this->belongsToMany(System\User);
    }

    public function terms() {
        return $this->belongsTo(System\Term);
    }

    public function questions() {
        return $this->hasMany(System\Question);
    }
}
