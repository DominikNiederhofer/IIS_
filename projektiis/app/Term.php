<?php

namespace System;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    public function evaluations() {
        return $this->hasMany(System\Evaluation);
    }

    public function exams() {
        return $this->belongsTo(System\Exam);
    }

    public function questions() {
        return $this->hasMany(System\Question);
    }

    public function users() {
        return $this->belongsToMany(System\User);
    }
}
