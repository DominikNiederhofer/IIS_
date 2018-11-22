<?php

namespace System;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function users() {
        return $this->belongsTo(System\User);
    }

    public function evaluations() {
        return $this->belongsTo(System\Evaluation);
    }

    public function terms() {
        return $this->belongsTo(System\Term);
    }
}
