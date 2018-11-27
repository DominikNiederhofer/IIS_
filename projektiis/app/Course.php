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

    public function students() {

        $users = $this->users()->get();
        $students = array();
        foreach ($users as $person) {
            if ($person->hasRole('student')) {
                $students[] = $person;
            }
        }
        return $students;
    }

}
