<?php

namespace System;

use Illuminate\Database\Eloquent\Model;
use System\User;

class Course extends Model
{
	protected $fillable = [
        'name', 'shortcut', 'credits' ,'type'
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function exams() {
        return $this->hasMany(Exam::class);
    }

}
