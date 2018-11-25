<?php

namespace System;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
	protected $fillable = [
        'max_students', 'max_points'
    ];

    public function courses() {
        return $this->belongsTo(Course::class);
    }

    public function terms() {
        return $this->hasMany(System\Term);
    }
}
