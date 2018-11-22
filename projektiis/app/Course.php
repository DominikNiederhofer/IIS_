<?php

namespace System;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users() {
        return $this->belongsToMany(System\User);
    }

    public function exams() {
        return $this->hasMany(Exam::class);
    }
}
