<?php

namespace System;

use Illuminate\Database\Eloquent\Model;
use System\User;

class Evaluation extends Model
{
    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function terms() {
        return $this->belongsTo(Term::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function getTeacher(){
    	$teacher = User::where('id', $this->teacher_id)->first();
    	return $teacher;
    }

}
